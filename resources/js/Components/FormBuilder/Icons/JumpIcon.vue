<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 31.965 18"
  >
    <path
      d="M18,21a3,3,0,1,1-3,3,3,3,0,0,1,3-3m17.19-7.71L32.805,23.625,22.5,21.24l5.7-3.57A12,12,0,0,0,6.18,21.945L3.225,21.42A15.007,15.007,0,0,1,30.75,16.08l4.44-2.79Z"
      transform="translate(-3.225 -9)"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'TrashIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
