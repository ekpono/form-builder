<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 15 15"
  >
    <path
      :fill="iconColor"
      d="M8,15a7,7,0,1,1,7-7,7,7,0,0,1-7,7ZM8,2a6,6,0,1,0,6,6A6,6,0,0,0,8,2Z"
    />
    <path
      :fill="iconColor"
      d="M10.3,11,7.5,8.2V3.5h1V7.79L11,10.3Z"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'ClockIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
