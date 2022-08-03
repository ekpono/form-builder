<template>
  <div class="relative">
    <QuestionCard
      :id="questionId"
      class="w-40"
      :title="`Move to form #${formId}`"
      category="form-transfer"
      :first-row="firstRow"
      tooltip-title="From transfer"
      @click:go-to-logic-jump="$emit('update:goToFormTransfer', $event)"
    />
  </div>
</template>

<script>
import QuestionCard from '../../../Components/FormBuilder/Canvas/QuestionCard'

export default {
  name: 'FormTransfer',
  components: {
    QuestionCard
  },
  props: {
    formId: { type: Number, required: true },
    firstRow: { type: Boolean, default: false },
    questionId: { type: String, required: true }
  },
  emits: ['update:goToFormTransfer']
}
</script>

<style scoped>

</style>
