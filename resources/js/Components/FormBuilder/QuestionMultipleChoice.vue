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
        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md bg-gray-200 pr-10"
        placeholder="Enter the choice"
        :value="choice.label"
        @input="$emit('update:properties', { ...properties, choices: properties.choices.map(c => c.id === choice.id ? { ...c, label: $event.target.value } : c) })"
        @keyup="$emit('spyCaret', `choices.${i}.label`, $event.target.selectionEnd)"
        @mouseup="$emit('spyCaret', `choices.${i}.label`, $event.target.selectionEnd)"
      >
      <div
        v-if="properties.choices && properties.choices.length > 1"
        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
        @click="removeChoice(i)"
      >
        <StopIcon
          class="h-5 w-5 text-gray-400"
          aria-hidden="true"
        />
      </div>
    </div>
  </div>
  <div
    class="my-3 py-2 text-navy underline"
  >
    <span
      class="cursor-pointer"
      @click="addChoice"
    >
      Add choice
    </span>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
import QuestionLabel from './QuestionLabel.vue'
import StopIcon from '../../Components/FormBuilder/Icons/StopIcon'
import { injectIntoString, merge, recursivelyGetProp } from '../../functions'

export default {
  name: 'QuestionMultipleChoice',
  components: { QuestionLabel, StopIcon },
  props: {
    properties: { type: Object, default: () => ({ choices: [] }) }
  },
  emits: ['update:properties', 'spyCaret'],
  updated: function () {
    if (!this.properties.choices?.length) {
      this.addChoice()
    }
  },
  methods: {
    uuid,
    addChoice: function () {
      this.$emit('update:properties', ({ ...this.properties, choices: [...(this.properties.choices || []), { id: uuid() }] }))
    },
    removeChoice: function (index) {
      this.$emit(
        'update:properties',
        {
          ...this.properties,
          choices: [...this.properties.choices.slice(0, index), ...this.properties.choices.slice(index + 1)]
        }
      )
    },
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
