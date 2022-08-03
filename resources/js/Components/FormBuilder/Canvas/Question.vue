<template>
  <div class="pb-20">
    <div class="flex gap-2 items-center">
      <QuestionCard
        :id="question.id"
        class="w-40"
        :title="question.title"
        :category="question.category"
        :type="question.type"
        :index="question.index"
        :question-type="question.type"
        :first-row="firstRow"
        @click="$emit('click')"
        @click:go-to-logic-jump="$emit('click:goToLogicJump', $event)"
      />
      <div
        v-if="answersToForms.length > 0"
        class="text-xxs text-gray-500 font-bold"
      >
        <div
          v-for="(c, index) in answersToForms"
          :key="`canvas-question-answer-to-form-${c.label}`"
          :ref="`af${index}`"
        >
          {{ c.label }}
        </div>
      </div>
    </div>
    <div
      class="flex justify-between text-xxs text-gray-500 font-bold w-40 px-2 pt-0.5"
      :class="{'pl-16': answersToQuestions.length < 3}"
    >
      <div
        v-for="(c, index) in answersToQuestions"
        :key="`canvas-question-answer-${c.label}`"
        :ref="`a${index}`"
        class="h-4"
        :class="{'border-l border-[#BFBFBF]' : !c.label}"
      >
        {{ c.label }}
      </div>
    </div>
    <div v-if="question.category === QUESTION_CATEGORY_TYP">
      <div class="w-1/2 h-20 -mt-1 border-r border-[#BFBFBF]" />
      <div class="flex justify-center pt-2">
        <div class="text-[#BFBFBF] text-xs flex gap-1 items-end">
          <ExitSignIcon class="h-6 w-6 text-gray-400 fill-current" />
          <div>
            Exit
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import QuestionCard from '../../../Components/FormBuilder/Canvas/QuestionCard'
import ExitSignIcon from '../../../Components/FormBuilder/Icons/ExitSignIcon'
import { QUESTION_CATEGORY_TYP, QUESTION_CATEGORY_KICK_OFF } from '../../../constants/Forms/questions'
import { compare } from '../../../functions'
import _ from 'lodash'

export default {
  components: { ExitSignIcon, QuestionCard },
  props: {
    question: { type: Object, required: true },
    logic: { type: Array, required: true },
    questions: { type: Array, required: true },
    firstRow: { type: Boolean, default: false }
  },
  emits: ['update:answersCoordinates', 'click:goToLogicJump', 'click'],
  data: function () {
    return {
      curRefs: this.$refs,
      curQuestion: this.question,
      QUESTION_CATEGORY_TYP,
      QUESTION_CATEGORY_KICK_OFF
    }
  },
  computed: {
    possibleAnswers: function () {
      if (this.question.category === QUESTION_CATEGORY_TYP) {
        return []
      }
      const answers = []
      let restOfChoices = this.question.properties?.choices || []
      let otherwise = this.questionIdByIndex(this.question.index + 1)
      for (const l of this.logic) {
        if (!l.goto || l.conditions.find(c => c.compare_with?.id ? !this.answerById(c.compare_with.id) : false)) {
          continue
        }
        answers.push({
          label: l.conditions.map(c => {
            let conditionLabel = c.compare_with?.val
            if (c.compare_with?.id) {
              const choice = this.answerById(c.compare_with?.id)
              conditionLabel = choice.label
              restOfChoices = restOfChoices.filter(c => c.op === '=== ' ? c.id === choice.id : c.id !== choice.id)
            }

            return (c.logic_op ? `${c.logic_op} ` : '') +
                (c.op !== '==' ? ` ${c.op} ` : '') +
                conditionLabel
          }).join(' '),
          goto: l.type === 'form'
            ? `form-${this.question.id}-${l.goto}`
            : l.goto,
          toForm: l.type === 'form'
        })
        otherwise = l.otherwise || otherwise
      }

      if (restOfChoices.length > 0) {
        answers.unshift(...restOfChoices.map(c => ({ label: c.label, goto: otherwise })))
      }

      return answers.length === 0
        ? [{
            label: this.question.properties.choices?.map(c => c.label).join('/'),
            goto: this.questionIdByIndex(this.question.index + 1)
          }]
        : answers
    },
    answersToForms: function () {
      return this.possibleAnswers.filter(a => a.toForm)
    },
    answersToQuestions: function () {
      return this.possibleAnswers.filter(a => !a.toForm)
    }
  },
  updated () {
    if (this.question.category === QUESTION_CATEGORY_TYP) {
      return
    }

    if (_.isEqual(this.$refs, this.curRefs) && _.isEqual(this.question, this.curQuestion)) {
      return
    }
    this.curRefs = this.$refs
    this.curQuestion = this.question

    this.$emit(
      'update:answersCoordinates',
      this.question.id,
      Object.keys(this.$refs).map(refname => {
        const isAnswerToForm = refname.indexOf('af') !== -1
        const answerIndex = isAnswerToForm
          ? refname.replace('af', '')
          : refname.replace('a', '')

        const c = this.$refs[refname][0]
        return [
          c.offsetLeft + (c.offsetWidth || 10) / 2,
          c.offsetTop + c.offsetHeight,
          (isAnswerToForm ? this.answersToForms[answerIndex] : this.answersToQuestions[answerIndex]).goto,
          isAnswerToForm
        ]
      })
    )
  },
  methods: {
    calculateNextQuestionId: function (answerId, answerValue) {
      for (const l of this.logic) {
        if (l.conditions.length > 1 || l.type === 'form') {
          continue
        }
        for (const condition of l.conditions) {
          if (compare(
            condition.compare_with?.id || condition.compare_with.val,
            condition.op,
            condition.compare_with?.id ? answerId : answerValue
          )) {
            return l.goto
          }
        }
      }
      return null
    },
    answerById: function (id) {
      return this.question.properties.choices?.find(c => c.id === id)
    },
    questionIdByIndex: function (i) {
      return this.questions[i - 1]?.id
    },
    questionIndexById: function (id) {
      return this.questions.find(q => q.id === id)?.index
    }
  }
}
</script>

<style scoped>

</style>
