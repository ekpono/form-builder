<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 33 31.35"
  >
    <g transform="translate(-3 -4.5)">
      <path :fill="iconColor" d="M6.3,7.8H27.75V19.35h3.3V7.8a3.3,3.3,0,0,0-3.3-3.3H6.3A3.3,3.3,0,0,0,3,7.8V27.6a3.3,3.3,0,0,0,3.3,3.3H19.5V27.6H6.3Z" transform="translate(0 0)"/>
      <path :fill="iconColor" d="M12.45,16.8,7.5,23.4H25.65l-6.6-9.9L14.1,20.1Z" transform="translate(0.45 0.9)"/>
      <path :fill="iconColor" d="M29.25,21h-3.3v4.95H21v3.3h4.95V34.2h3.3V29.25H34.2v-3.3H29.25Z" transform="translate(1.8 1.65)"/>
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'AddMediaIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>