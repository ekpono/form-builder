<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 24.729 24.72"
  >
    <path
      :fill="iconColor"
      d="M22.242,18l2.123,2.121,4.242-4.242a6,6,0,0,0-8.486-8.486l-4.242,4.242L18,13.758l4.242-4.244a3,3,0,0,1,4.244,4.244Z"
      transform="translate(-5.635 -5.635)"
    />
    <path
      :fill="iconColor"
      d="M18,22.244l2.121,2.121-4.242,4.242a6,6,0,0,1-8.486-8.486l4.242-4.242L13.758,18,9.514,22.244a3,3,0,1,0,4.244,4.242L18,22.242Z"
      transform="translate(-5.635 -5.635)"
    />
    <path
      :fill="iconColor"
      d="M22.244,15.879a1.5,1.5,0,1,0-2.123-2.123l-6.363,6.365a1.5,1.5,0,1,0,2.121,2.121l6.363-6.363Z"
      transform="translate(-5.635 -5.635)"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'LinkIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
