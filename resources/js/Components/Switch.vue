<template>
  <Toggler
    :model-value="modelValue"
    :class="[modelValue ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-4 w-6 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2']"
    @update:modelValue="$emit('update:modelValue', $event)"
  >
    <span class="sr-only">Use setting</span>
    <span
      aria-hidden="true"
      :class="[modelValue ? 'translate-x-2' : 'translate-x-0', 'pointer-events-none inline-block h-3 w-3 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']"
    />
  </Toggler>
</template>

<script>
import { Switch as Toggler } from '@headlessui/vue'

export default {
  name: 'Switch',
  components: {
    Toggler
  },
  props: {
    modelValue: {
      type: Boolean,
      default: false
    }
  },
  emits: ['update:modelValue']
}
</script>

<style scoped>
</style>
