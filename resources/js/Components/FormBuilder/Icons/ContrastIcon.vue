<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 512 512"
  >
    <circle
      cx="256"
      cy="256"
      r="208"
      class="stroke-current"
      style="fill:none;stroke-linejoin:round;stroke-width:32px"
    />
    <path
      d="M256,464C141.12,464,48,370.88,48,256S141.12,48,256,48Z"
      class="fill-current"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from '../../../Components/FormBuilder/Icons/IconBase'

export default {
  name: 'ContrastIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>
