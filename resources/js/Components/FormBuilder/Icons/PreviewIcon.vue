<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 16 11"
  >
    <path
      fill-rule="evenodd"
      d="M16,8S13,2.5,8,2.5,0,8,0,8s3,5.5,8,5.5S16,8,16,8ZM1.173,8a13.134,13.134,0,0,0,1.66,2.043A7.451,7.451,0,0,0,8,12.5a7.457,7.457,0,0,0,5.168-2.457A13.134,13.134,0,0,0,14.828,8a13.133,13.133,0,0,0-1.66-2.043A7.459,7.459,0,0,0,8,3.5,7.457,7.457,0,0,0,2.832,5.957,13.133,13.133,0,0,0,1.172,8Z"
      transform="translate(0 -2.5)"
    />
    <path
      fill-rule="evenodd"
      d="M8,5.5A2.5,2.5,0,1,0,10.5,8,2.5,2.5,0,0,0,8,5.5ZM4.5,8A3.5,3.5,0,1,1,8,11.5,3.5,3.5,0,0,1,4.5,8Z"
      transform="translate(0 -2.5)"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'PreviewIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>
