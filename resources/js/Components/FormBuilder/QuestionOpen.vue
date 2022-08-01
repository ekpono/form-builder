<template>
  <div>
    <input
      type="text"
      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md text-gray-500 italic"
      placeholder="Enter the placeholder"
      :value="properties?.placeholder || ''"
      @input="$emit('update:properties', { ...properties, placeholder: $event.target.value })"
    >
  </div>
</template>

<script>
export default {
  name: 'QuestionOpen',
  props: {
    properties: { type: Object, default: () => ({}) }
  },
  emits: ['update:properties']
}
</script>

<style scoped>
</style>
