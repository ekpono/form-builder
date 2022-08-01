<template>
  <div class="flex gap-3">
    <button
      class="bg-blue-600 rounded text-white px-9 py-1.5 font-semibold hover:bg-blue-800 duration-300"
      @click="$emit('click:ok')"
    >
      Ok
    </button>
    <button
      type="button"
      class="border border-blue-600 rounded text-blue-600 px-6 py-1.5 font-semibold hover:text-blue-800 hover:border-blue-800 duration-300"
      @click="$emit('click:cancel')"
    >
      Cancel
    </button>
  </div>
</template>

<script>
export default {
  name: 'ActionButtons',
  emits: ['click:ok', 'click:cancel']
}
</script>

<style scoped>

</style>
