<template>
  <div class="flex text-gray-500 px-3 py-5 text-xs border-b">
    <div class="w-1/3 text-right">
      <div
        class="cursor-pointer select-none"
        @click="$emit('update:offsetQuestion', -1)"
      >
        ◄ See previous question
      </div>
    </div>
    <div class="w-1/3 text-center">
      <div class="mb-2">
        <button
          class="rounded border py-1 px-2 w-40"
          @click="$emit('update:duplicateCurrentQuestion')"
        >
          Duplicate question
        </button>
      </div>
      <div>
        <button
          class="rounded border py-1 px-2 w-40 select-none"
          @click="$emit('click:previewCurrentQuestion')"
        >
          Preview this question
        </button>
      </div>
    </div>
    <div class="w-1/3">
      <div
        class="cursor-pointer"
        @click="$emit('update:offsetQuestion', 1)"
      >
        See next question ►
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'QuestionNav',
  emits: ['update:offsetQuestion', 'update:duplicateCurrentQuestion', 'click:previewCurrentQuestion']
}
</script>

<style scoped>
</style>
