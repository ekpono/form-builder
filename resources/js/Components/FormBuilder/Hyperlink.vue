<template>
  <div class="px-3">
    <div class="py-2 text-xs flex justify-between items-center">
      <Label class="w-1/4">URL</Label>
      <Input
        class="py-1 text-sm w-3/4"
        type="text"
        placeholder="Enter the link address"
      />
    </div>
    <div class="py-2 text-xs flex justify-between items-center">
      <Label class="w-1/4">Text</Label>
      <Input
        class="py-1 text-sm w-3/4"
        type="text"
        placeholder="Enter the link text"
      />
    </div>
    <div class="py-4 text-right">
      <button class="text-sm text-white bg-red-600 rounded px-4 py-1">
        Remove link
      </button>
    </div>
  </div>
</template>

<script>
import Input from '../../Components/Input'
import Label from '../../Components/Label'

export default {
  name: 'Hyperlink',
  components: { Input, Label },
  props: {
    questions: { type: Array, default: () => [] },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => [] },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic']
}
</script>

<style scoped>

</style>
