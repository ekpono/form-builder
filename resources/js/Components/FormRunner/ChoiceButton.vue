<template>
  <button
    class="choice p-4 font-semibold transition-all duration-300 flex justify-between items-center"
    :class="checked ? ['checked'] : []"
    @click="$emit('click', $event)"
  >
    <slot />
    <CheckCircleIcon
      v-show="checked"
      class="h-4 fill-green"
    />
  </button>
</template>

<script>
import { CheckCircleIcon } from '@heroicons/vue/solid'

export default {
  name: 'ChoiceButton',
  components: {
    CheckCircleIcon
  },
  props: {
    checked: { type: Boolean, default: false }
  },
  emits: ['click']
}
</script>

<style scoped>
.choice {
    background-color: #F2F2F2;
    border: 2px solid #F2F2F2;
    border-radius: 5px;
    color: #111111;
    font-size: 18px;
    line-height: 22px;
}
.choice.checked {
    background-color: #EDF8F0;
    border: 2px solid #428A54;
}
.fill-green {
    fill: #428A54;
}
</style>
