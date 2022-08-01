<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 26 26"
  >
    <g transform="translate(1 1)">
      <path
        fill="none"
        :stroke="iconColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2px"
        d="M12,24H9a3,3,0,0,1-3-3V9A3,3,0,0,1,9,6H21a3,3,0,0,1,3,3v3M15,30H27a3,3,0,0,0,3-3V15a3,3,0,0,0-3-3H15a3,3,0,0,0-3,3V27a3,3,0,0,0,3,3Z"
        transform="translate(-6 -6)"
      />
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'DuplicateIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
