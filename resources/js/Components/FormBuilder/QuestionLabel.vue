<template>
  <div
    :class="[
      `h-${height} w-${width} rounded-r-full bg-gray-100 flex items-center pl-1 pr-2`,
      centered ? 'justify-center' : 'justify-between'
    ]"
  >
    <slot />
  </div>
</template>

<script>
export default {
  name: 'QuestionLabel',
  props: {
    centered: { type: Boolean, default: false },
    height: { type: Number, default: 5 },
    width: { type: Number, default: 10 }
  }
}
</script>

<style scoped>

</style>
