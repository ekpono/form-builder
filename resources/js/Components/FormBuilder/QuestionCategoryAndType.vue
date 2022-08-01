<template>
  <div class="border-b pt-2 pb-3 px-3 relative z-20">
    <SelectBox
      label="Question category"
      :model-value="category"
      :items="categoriesOptions"
      placeholder="Choose the category"
      @update:modelValue="$emit('update:category', $event)"
    />
  </div>
  <div
    v-if="category !== QUESTION_CATEGORY_TYP"
    class="border-b pt-2 pb-3 px-3 relative z-10"
  >
    <div
      v-if="!category"
      class="opacity-10 bg-black absolute left-0 right-0 bottom-0 top-0 z-10"
    />
    <SelectBox
      label="Question type"
      :model-value="type"
      :items="typesOptions"
      placeholder="Choose the type"
      :disabled="!category"
      @update:modelValue="$emit('update:type', $event)"
    />
  </div>
</template>

<script>
import SelectBox from '../SelectBox.vue'
import {
  QUESTION_TYPE_MULTIPLE_CHOICE,
  QUESTION_TYPE_OPEN,
  QUESTION_TYPE_YES_NO,
  QUESTION_CATEGORY_KICK_OFF,
  QUESTION_CATEGORY_FOLLOW_UP,
  QUESTION_CATEGORY_TYP,
  QUESTION_TYPE_DELAY, QUESTION_TYPE_RATING_SCORE
} from '@/constants/Forms/questions'
import QuestionIcon from '@/Components/FormBuilder/Icons/QuestionIcon'
import QuestionAddIcon from '@/Components/FormBuilder/Icons/QuestionAddIcon'
import HandshakeIcon from '@/Components/FormBuilder/Icons/HandshakeIcon'
import MultipleChoiceIcon from '@/Components/FormBuilder/Icons/MultipleChoiceIcon'
import ClockIcon from '@/Components/FormBuilder/Icons/ClockIcon'
import { StarIcon } from '@heroicons/vue/outline'
import { UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY } from '@/constants/Forms/form'

export default {
  name: 'QuestionCategoryAndType',
  components: {
    SelectBox
  },
  props: {
    category: { type: String, default: null },
    type: { type: String, default: null },
    formCategory: { type: String, required: true }
  },
  emits: ['update:category', 'update:type'],
  data: function () {
    return {
      categoriesOptions: Object.freeze([
        { value: QUESTION_CATEGORY_KICK_OFF, title: 'Kick-off question', icon: { component: QuestionIcon, style: 'bg-kick_off' } },
        { value: QUESTION_CATEGORY_FOLLOW_UP, title: 'Follow up question', icon: { component: QuestionAddIcon, height: 11 } },
        { value: QUESTION_CATEGORY_TYP, title: 'Thank you page', icon: { component: HandshakeIcon, style: 'bg-typ' } }
      ]),
      questionCategory: this.category,
      questionType: this.type,
      QUESTION_CATEGORY_TYP: QUESTION_CATEGORY_TYP
    }
  },
  computed: {
    typesOptions: function () {
      return [
        { value: QUESTION_TYPE_MULTIPLE_CHOICE, title: 'Multiple choice', icon: { component: MultipleChoiceIcon, style: 'bg-multiple_choice' } },
        { value: QUESTION_TYPE_YES_NO, title: 'Yes/no', icon: { component: MultipleChoiceIcon } },
        { value: QUESTION_TYPE_OPEN, title: 'Open', icon: { component: QuestionIcon } },
        { value: QUESTION_TYPE_DELAY, title: 'Time delay', icon: { component: ClockIcon, height: 14, style: 'bg-time_delay' } },
        { value: QUESTION_TYPE_RATING_SCORE, title: 'Rating score', icon: { component: StarIcon } }
      ].filter(t => UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY[this.formCategory].indexOf(t.value) === -1)
    }
  }
}
</script>

<style scoped>
</style>
