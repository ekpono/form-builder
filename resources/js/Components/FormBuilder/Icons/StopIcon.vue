<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 17 17"
  >
    <circle
      cx="8.5"
      cy="8.5"
      r="8.5"
    />
    <line
      y1="9"
      y2="9"
      stroke="#fff"
      x2="13"
      x1="4"
      stroke-width="2"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'StopIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>
