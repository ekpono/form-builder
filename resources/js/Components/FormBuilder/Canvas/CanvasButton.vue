<template>
  <div
    class="flex justify-end absolute top-0 left-0 z-30 w-1/5 bg-white px-1 py-2 whitespace-nowrap canvas-button-shadow rounded"
  >
    <button
      class="flex gap-2 text-txtgray text-xxs"
      @click="$emit('onClick')"
    >
      <span
        class="delay-300"
      >Open Canvas</span>
      <ChevronDoubleRightIcon
        class="h-5 w-5 duration-300"
      />
    </button>
  </div>
</template>

<script>
import { ChevronDoubleRightIcon } from '@heroicons/vue/solid'

export default {
  name: 'CanvasButton',
  components: { ChevronDoubleRightIcon },
  emits: ['onClick']
}
</script>

<style scoped>
.canvas-button-shadow:after {
    content: '';
    display: block;
    width: 17%;
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 0;
    @apply rounded;
    @apply pointer-events-none;
    box-shadow: 11px 4px 15px #0000001f;
}
</style>
