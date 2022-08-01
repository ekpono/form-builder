<template>
  <div>
    <div
      class="cursor-pointer flex justify-between select-none"
      @click="handleClick"
    >
      {{ title }}
      <ChevronDownIcon
        v-if="!open"
        class="h-4"
      />
      <ChevronUpIcon
        v-if="open"
        class="h-4"
      />
    </div>
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div v-show="open">
        <slot />
      </div>
    </transition>
  </div>
</template>
<script>
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/outline'

export default {
  name: 'Accordion',
  components: { ChevronDownIcon, ChevronUpIcon },
  props: { title: { type: String, required: true } },
  data () {
    return {
      open: false
    }
  },
  methods: {
    handleClick: function () {
      this.open = !this.open
    }
  }
}
</script>

<style scoped>

</style>
