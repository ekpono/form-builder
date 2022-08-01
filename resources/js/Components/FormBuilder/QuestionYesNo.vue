<template>
  <div
    v-for="(choice, i) in properties.choices"
    :key="`multiple-choice${i}${choice.id}`"
  >
    <div class="mt-1 relative rounded-md shadow-sm">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <QuestionLabel centered>
          <small>{{ i + 1 }}</small>
        </QuestionLabel>
      </div>
      <input
        :ref="`choices.${i}.label`"
        type="text"
        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md bg-gray-200"
        :placeholder="i ? 'No': 'Yes'"
        :value="choice.label"
        @input="$emit('update:properties', { ...properties, choices: properties.choices.map(c => c.id === choice.id ? { ...c, label: $event.target.value } : c) })"
        @keyup="$emit('spyCaret', `choices.${i}.label`, $event.target.selectionEnd)"
        @mouseup="$emit('spyCaret', `choices.${i}.label`, $event.target.selectionEnd)"
      >
    </div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
import QuestionLabel from './QuestionLabel.vue'
import { injectIntoString, merge, recursivelyGetProp } from '@/functions'

export default {
  name: 'QuestionYesNo',
  components: {
    QuestionLabel
  },
  props: {
    properties: { type: Object, default: () => ({ choices: [] }) }
  },
  emits: ['update:properties', 'spyCaret'],
  setup: function (props, context) {
    if (!props.properties.choices?.length) {
      context.emit('update:properties', ({
        ...props.properties,
        choices: [
          { id: uuid(), label: 'Yes' },
          { id: uuid(), label: 'No' }]
      }))
    }
  },
  methods: {
    addEmojiAndFocus: function (e, property, pos) {
      const path = property.split('.')
      this.$emit(
        'update:properties',
        {
          ...this.properties,
          ...merge({ ...this.properties }, path.reduceRight((all, item) => ({ [item]: all }), injectIntoString(recursivelyGetProp(this.properties, path), pos, e)))
        }
      )
      const el = this.$refs[property]
      el.focus()
      setTimeout(() => {
        el.selectionEnd = pos + 1
      }, 1)
    }
  }
}
</script>

<style scoped>
</style>
