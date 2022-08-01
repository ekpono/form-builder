<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 10 10"
  >
    <path
      d="M9.763,2v.913H11.4L7.48,6.834,3.559,2.913H5.2V2H2V5.2h.913V3.559l4.11,4.11V12.96h.913V7.669l4.11-4.11V5.2h.913V2Z"
      transform="translate(-2 -2)"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'MultipleChoiceIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
