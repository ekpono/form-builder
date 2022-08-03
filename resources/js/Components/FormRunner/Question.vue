<template>
  <div class="w-full">
    <div
      class="title"
      :style="{color: theme?.questions}"
    >
      {{ title }}
    </div>
    <div
      v-if="description"
      class="description pb-2"
      :style="{color: theme?.descriptions}"
    >
      {{ description }}
    </div>
    <div
      v-if="question.attachments && question.attachments.length > 0"
      class="flex"
    >
      <div class="max-w-md w-full rounded overflow-hidden bg-gray-400 media-container relative">
        <div class="absolute flex left-0 right-0 bottom-0 top-0 items-center justify-center z-0">
          <PhotographIcon class="h-12 w-12 text-white" />
        </div>
        <img
          v-for="a in question.attachments"
          :key="a.src"
          class="w-full z-10 relative"
          :src="`/storage/${a.src}`"
          alt=""
        >
      </div>
    </div>
    <div class="py-4">
      <component
        :is="componentQuestionTypeMap"
        :key="question.id + (orderItem || '')"
        :properties="question.properties"
        :with-confirmation="withConfirmation"
        :question-category="question.category"
        :order-items="orderItems"
        :init-value="initValue"
        :is-mobile="isMobile"
        @update:answer="$emit('update:answer', $event)"
        @update:error="handleError"
        @update:value="handleUpdateValue"
        @upload:file="$emit('upload:file', $event)"
      />
      <ErrorMessage v-if="error">
        {{ error }}
      </ErrorMessage>
      <div
        class="pt-7 flex gap-6"
      >
        <button
          v-if="value && value.length > 0"
          :disabled="!!error"
          class="bg-buttonRed text-white rounded py-2.5 px-5 font-bold disabled:opacity-75"
          :style="{background: theme?.buttons, color: theme?.button_text}"
          @click="sendAnswer"
        >
          {{ nextButtonText }}
        </button>
        <button
          v-if="showBack"
          class="text-red-600 font-semibold"
          :style="{color: theme?.buttons}"
          @click="$emit('clickBack')"
        >
          Back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import {
  QUESTION_TYPE_PURCHASED_ITEMS_CHOICE,
  QUESTION_CATEGORY_KICK_OFF,
  QUESTION_TYPE_DELAY,
  QUESTION_TYPE_MULTIPLE_CHOICE,
  QUESTION_TYPE_OPEN, QUESTION_TYPE_RATING_SCORE,
  QUESTION_TYPE_YES_NO, QUESTION_CATEGORY_TYP, QUESTION_TYPE_UPLOAD_FILES
} from '../../constants/Forms/questions'
import MultipleChoice from '../../Components/FormRunner/MultipleChoice'
import YesNo from '../../Components/FormRunner/YesNo'
import Open from '../../Components/FormRunner/Open'
import RatingScore from '../../Components/FormRunner/RatingScore'
import TimeDelay from '../../Components/FormRunner/TimeDelay'
import { FORM_CATEGORY_PRE_REVIEW } from '../../constants/Forms/form'
import PurchasedItemsChoice from '../../Components/FormRunner/PurchasedItemsChoice'
import { mergeTags, recallInfo } from '../../forms'
import ErrorMessage from '../../Components/FormRunner/ErrorMessage'
import UploadFiles from '../../Components/FormRunner/UploadFiles'
import { PhotographIcon } from '@heroicons/vue/solid'

export default {
  components: { ErrorMessage, PhotographIcon },
  props: {
    question: { type: Object, required: true },
    tags: { type: Object, default: () => ({}) },
    formProgress: { type: Array, required: true },
    formCategory: { type: String, required: true },
    orderItems: { type: Array, default: () => ([]) },
    theme: { type: Object, default: () => ({}) },
    orderItem: { type: Object, default: undefined },
    isMobile: { type: Boolean, default: false },
    isLastQuestion: { type: Boolean, default: false }
  },
  emits: ['update:answer', 'clickBack', 'upload:file'],
  data: function () {
    return {
      error: null,
      value: null
    }
  },
  computed: {
    showBack: function () {
      return this.question.index !== 0 && this.question.category !== QUESTION_CATEGORY_TYP
    },
    componentQuestionTypeMap: function () {
      return {
        [QUESTION_TYPE_MULTIPLE_CHOICE]: MultipleChoice,
        [QUESTION_TYPE_YES_NO]: YesNo,
        [QUESTION_TYPE_OPEN]: Open,
        [QUESTION_TYPE_RATING_SCORE]: RatingScore,
        [QUESTION_TYPE_DELAY]: TimeDelay,
        [QUESTION_TYPE_PURCHASED_ITEMS_CHOICE]: PurchasedItemsChoice,
        [QUESTION_TYPE_UPLOAD_FILES]: UploadFiles
      }[this.question.type] || null
    },
    title: function () {
      return recallInfo(mergeTags(this.question.title, this.tags), this.formProgress)
    },
    description: function () {
      return recallInfo(mergeTags(this.question.description, this.tags), this.formProgress)
    },
    withConfirmation: function () {
      return this.question.category === QUESTION_CATEGORY_KICK_OFF && this.formCategory === FORM_CATEGORY_PRE_REVIEW
    },
    initValue: function () {
      return this.formProgress.find(a => (a.orderItem ? a.orderItem === this.orderItem?.external_product_id : true) && a.questionId === this.question.id)?.answers || []
    },
    nextButtonText: function () {
      return this.isLastQuestion ? 'Submit my answers' : 'Next question'
    }
  },
  mounted () {
    const storedValue = this.formProgress.find(a => a.questionId === this.question.id)?.answers
    storedValue && (this.value = storedValue)
  },
  methods: {
    handleError: function (errorMessage) {
      this.error = errorMessage
    },
    handleUpdateValue: function (value) {
      this.value = value
    },
    sendAnswer: function () {
      if (!this.value) {
        return
      }
      this.$emit('update:answer', this.value)
    }
  }
}
</script>

<style scoped>
.title {
    color: #111111;
    font-size: 22px;
    line-height: 26px;
}
.description {
    color: #666666;
    font-size: 18px;
    line-height: 22px;
}
.media-container {
    min-height: 200px;
    z-index: 1;
}
</style>
