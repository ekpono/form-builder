<template>
  <LeftSide
    class="fixed bottom-0 left-0 right-0 z-10"
    :class="{
      'lg:relative lg:w-1/2': !isMobile,
      'absolute': isPreview && isMobile,
      'fixed': !isPreview && isMobile
    }"
    :form-name="form.name"
    :order-item="orderItem"
    :questions="kickOffsAndFollowUps"
    :form-category="formCategory"
    :current-question-id="currentQuestion?.id"
    :tags="tags"
    :is-mobile="isMobile"
  />
  <div
    class="flex flex-col py-16 px-5 overflow-y-auto h-full w-full"
    :class="{'lg:w-1/2 lg:px-16': !isMobile}"
    :style="{backgroundColor: theme?.background}"
  >
    <div class="flex justify-between">
      <div class="text-xl font-bold">
        {{ order.store.domain }}
      </div>
      <div
        v-if="orderItem"
        class="order-item p-4"
      >
        <div class="order-item-reviewing">
          Reviewing
        </div>
        <div class="font-semibold">
          {{ orderItem.name }}
        </div>
      </div>
    </div>
    <div
      v-if="!noQuestion && currentQuestion"
      class="flex-grow flex items-center"
    >
      <Question
        :key="currentQuestion.id"
        :question="currentQuestion"
        :tags="tags"
        :form-progress="answers"
        :form-category="form.category"
        :order-items="orderItems"
        :theme="theme"
        :order-item="orderItem"
        :is-mobile="isMobile"
        :is-last-question="isLastQuestion"
        @update:answer="handleAnswer"
        @upload:file="$emit('uploadFile', $event)"
        @clickBack="backToThePreviousAnswer"
      />
    </div>
  </div>
</template>

<script>
import {
  PURCHASED_ITEMS_CHOICE_QUESTION,
  QUESTION_CATEGORY_FOLLOW_UP,
  QUESTION_CATEGORY_KICK_OFF, QUESTION_CATEGORY_TYP,
  QUESTION_TYPE_PURCHASED_ITEMS_CHOICE, uploadFilesQuestion
} from '@/constants/Forms/questions'
import { FORM_CATEGORY_REVIEW, FORM_TYPE_PRODUCT } from '@/constants/Forms/form'
import LeftSide from '@/Components/FormRunner/LeftSide'
import Question from './Question'

export default {
  components: {
    LeftSide,
    Question
  },
  props: {
    form: { type: Object, required: true },
    theme: { type: Object, default: () => ({}) },
    order: { type: Object, required: true },
    formProgress: { type: Array, required: true },
    chosenOrderItems: { type: Array, default: () => ([]) },
    isMobile: { type: Boolean, default: false },
    isPreview: { type: Boolean, default: false }
  },
  emits: ['update:progress', 'update:orderItems', 'update:goToForm', 'uploadFile'],
  data: function () {
    return {
      currentQuestion: null,
      noQuestion: true
    }
  },
  computed: {
    formType: function () {
      return this.form.type
    },
    formCategory: function () {
      return this.form.category
    },
    tags: function () {
      return {
        ...this.order.data.customer,
        ...(this.orderItem ? { product_name: this.orderItem.name } : {})
      }
    },
    orderItems: function () {
      return this.order.data.line_items
    },
    kickOffsAndFollowUps: function () {
      return [
        ...this.form.data.kick_offs.map(q => ({ ...q, category: QUESTION_CATEGORY_KICK_OFF })),
        ...this.form.data.follow_ups.map(q => ({ ...q, category: QUESTION_CATEGORY_FOLLOW_UP }))
      ]
    },
    questions: function () {
      return [
        ...(this.formType === FORM_TYPE_PRODUCT && this.formCategory === FORM_CATEGORY_REVIEW ? [PURCHASED_ITEMS_CHOICE_QUESTION] : []),
        ...this.chosenOrderItems.length > 0
          ? this.chosenOrderItems.reduce((acc, i) => [
            ...acc,
            ...this.kickOffsAndFollowUps.map(q => ({ ...q, order_item_id: i })),
            ...this.form.data.allow_users_files ? [uploadFilesQuestion(i)] : []
          ], [])
          : this.kickOffsAndFollowUps,
        ...this.form.data.typs.map(q => ({ ...q, category: QUESTION_CATEGORY_TYP }))
      ].map((q, index) => ({ ...q, index }))
    },
    answers: function () {
      return this.formProgress.map(a => ({ ...a, index: this.questions.find(q => q.id === a.questionId)?.index }))
    },
    orderItem: function () {
      return this.currentQuestion?.order_item_id && this.orderItems.find(i => i.external_product_id === this.currentQuestion.order_item_id)
    },
    isLastQuestion: function () {
      return this.questions[this.currentQuestion.index + 1]?.category === QUESTION_CATEGORY_TYP
    }
  },
  watch: {
    chosenOrderItems: {
      deep: true,
      handler: function () {
        if (this.currentQuestion) {
          this.setNextQuestion(this.formProgress)
        }
      }
    }
  },
  mounted () {
    if (this.formProgress && this.formProgress.length > 0) {
      this.setNextQuestion(this.formProgress)
    } else {
      this.currentQuestion = this.questions[0]
    }
    this.noQuestion = false
  },
  methods: {
    handleAnswer: function (answers) {
      const currentAnswerIndex = this.formProgress.findIndex(a => a.questionId === this.currentQuestion.id && (a.orderItem ? this.orderItem.external_product_id === a.orderItem : true))
      const answer = { questionId: this.currentQuestion.id, answers, ...(this.orderItem ? { orderItem: this.orderItem.external_product_id } : {}) }
      const formProgress = currentAnswerIndex === -1
        ? [...this.formProgress, answer]
        : [...this.formProgress.slice(0, currentAnswerIndex), answer]
      this.$emit('update:progress', formProgress)
      if (this.currentQuestion.id === QUESTION_TYPE_PURCHASED_ITEMS_CHOICE) {
        this.$emit('update:orderItems', answers.map(i => i.id))
      }
      this.setNextQuestion(formProgress)
    },
    setNextQuestion: function (formProgress) {
      const lastAnswer = formProgress[formProgress.length - 1]
      const lastAnswerIndex = this.questions
        .findIndex(q => q.id === lastAnswer.questionId && (lastAnswer.orderItem ? q.order_item_id === lastAnswer?.orderItem : true))
      const questionLogic = this.form.data.logic.filter(l => l.question_id === lastAnswer.questionId)
      if (questionLogic.length === 0) {
        this.currentQuestion = this.questions[lastAnswerIndex + 1]
        return
      }
      const nextQuestionId = this.nextQuestionConsideringLogic(questionLogic, lastAnswer.answers)
      this.currentQuestion = nextQuestionId
        ? this.questions[this.questions.findIndex(q => {
          if (q.id !== nextQuestionId) {
            return false
          }
          return q.order_item_id ? !formProgress.find(a => a.orderItem === q.order_item_id && a.questionId === q.id) : true
        })]
        : this.questions[lastAnswerIndex + 1]
    },
    nextQuestionConsideringLogic: function (logics, answers) {
      for (const l of logics) {
        let isTrue = false
        for (const condition of (l.conditions || [])) {
          if (condition.logic_op === 'AND' && !isTrue) {
            break
          }
          if (!condition.op || (!condition.compare_with?.id && !condition.compare_with?.value)) {
            continue
          }
          switch (condition.op) {
            case '==':
              isTrue = !!answers.find(a => condition.compare_with?.id ? a.id === condition.compare_with.id : a.value === condition.compare_with.value)
              break
            case '!=':
              isTrue = !!answers.find(a => condition.compare_with?.id ? a.id !== condition.compare_with.id : a.value !== condition.compare_with.value)
              break
            case '>':
              isTrue = !!answers.find(a => a.value > condition.compare_with?.value)
              break
            case '<':
              isTrue = !!answers.find(a => a.value < condition.compare_with?.value)
              break
            case '>=':
              isTrue = !!answers.find(a => a.value >= condition.compare_with?.value)
              break
            case '<=':
              isTrue = !!answers.find(a => a.value <= condition.compare_with?.value)
              break
          }
        }
        if (isTrue && l.goto) {
          if (l.type === 'form') {
            this.noQuestion = true
            this.$emit('update:goToForm', l.goto)
            return
          }
          return l.goto
        }
      }
      if (logics[0].otherwise) {
        return logics[0].otherwise
      }
    },
    backToThePreviousAnswer: function () {
      const currAnswerIndex = this.answers.findIndex(a => a.questionId === this.currentQuestion.id)
      this.currentQuestion = this.questions.find(q => q.id === this.answers[currAnswerIndex === -1 ? (this.answers.length - 1) : (currAnswerIndex - 1)].questionId)
    }
  }
}
</script>

<style scoped>
.order-item {
    background-color: #F2F2F2;
    border-radius: 5px;
    color: #111111;
    font-size: 12px;
    line-height: 14px;
    max-width: 300px;
}
.order-item-reviewing {
    color: #111111;
    font-size: 11px;
    line-height: 13px;
}
</style>
