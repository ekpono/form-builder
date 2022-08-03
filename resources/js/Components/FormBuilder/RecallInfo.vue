<template>
  <div class="px-3 py-4">
    <SelectBox
      label="Recall information from answer to question"
      :items="questionSelectBoxItems"
      :model-value="question.id"
      classes="h-10"
      placeholder="Choose the question"
      @update:modelValue="$emit('update:addMark', $event)"
    />
  </div>
</template>

<script>
import SelectBox from '../../Components/SelectBox'
import { QUESTION_CATEGORY_KICK_OFF } from '../../constants/Forms/questions'

export default {
  name: 'RecallInfo',
  components: {
    SelectBox
  },
  props: {
    questions: { type: Array, default: () => ([]) },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => ([]) },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['click:addMedia', 'click:emoji', 'update:addMark'],
  computed: {
    questionSelectBoxItems: function () {
      return this.questions.slice(0, this.questions.findIndex(q => q.id === this.question.id))
        .map(q => ({
          // TODO use question.id and replace it with this mark in TextField component
          value: `[Recall info = answer to ${q.category === QUESTION_CATEGORY_KICK_OFF ? 'KO' : 'FO'}Q-${q.index}]`,
          title: `Q${q.index} - ` + (q.title || 'No title')
        }))
    }
  }
}
</script>

<style scoped>

</style>
