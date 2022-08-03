<template>
  <span class="mark pointer-events-auto text-red-600 relative">
    <slot />
    <button
      class="mark-delete absolute hidden left-full top-0"
      @click="$emit('clickDelete')"
    >
      <StopIcon />
    </button>
  </span>
</template>

<script>
import StopIcon from '../../Components/FormBuilder/Icons/StopIcon'

export default {
  name: 'TextFieldMark',
  components: {
    StopIcon
  },
  emits: ['clickDelete']
}
</script>

<style scoped>
.mark:hover .mark-delete {
    display: block;
}
</style>
