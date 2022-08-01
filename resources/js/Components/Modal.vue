<template>
  <div
    ref="overlay"
    class="fixed top-0 left-0 bottom-0 right-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 px-4 focus:ring-0 focus:border-0 focus:outline-none"
    tabindex="0"
    @keydown.esc="$emit('close')"
  >
    <div class="bg-white pt-2 pb-8 rounded w-full max-w-md">
      <div class="text-right px-2">
        <button @click="$emit('close')">
          <XIcon class="h-4 fill-current text-gray-500" />
        </button>
      </div>
      <div class="px-4">
        <div class="text-center ">
          <slot />
        </div>
        <div
          v-if="buttons && buttons.length > 0"
          class="flex gap-2 justify-center pt-4"
        >
          <button
            v-for="(b, i) in buttons"
            :key="`modal-button-${i}`"
            class="border rounded px-6 py-1.5 font-semibold hover:opacity-80 duration-300"
            :class="[b.primary ? 'bg-blue-600 text-white' : 'border-blue-600 text-blue-600']"
            @click="b.onClick"
          >
            {{ b.text }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline'

export default {
  name: 'Modal',
  components: {
    XIcon
  },
  props: {
    buttons: { type: Array, default: null }
  },
  emits: ['close'],
  mounted () {
    this.$refs.overlay.focus()
  }
}
</script>

<style scoped>

</style>
