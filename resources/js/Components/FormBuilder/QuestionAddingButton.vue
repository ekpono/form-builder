<template>
  <div class="group flex gap-4 mt-3 text-gray-600 items-center cursor-pointer">
    <div
      class="w-8 h-8 p-1 bg-gray-200 rounded text-gray-400 group-hover:bg-blue-600 group-hover:text-white duration-300"
      :class="active ? ['bg-blue-600', 'text-white'] : []"
    >
      <PlusIcon :class="active ? ['text-white'] : []" />
    </div>
    <div class="text-xs">
      Add Question
    </div>
  </div>
</template>

<script>
import { PlusIcon } from '@heroicons/vue/solid'

export default {
  name: 'QuestionAddingButton',
  components: {
    PlusIcon
  },
  props: {
    active: { type: Boolean, default: false }
  }
}
</script>

<style scoped>
</style>
