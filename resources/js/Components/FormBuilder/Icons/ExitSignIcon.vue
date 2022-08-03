<template>
  <icon-base
    v-bind="$props"
  >
    <path
      class="fill-current"
      d="M14.8,3.852a1.235,1.235,0,0,0-.881-.364H9.462V1H8.218V3.487H3.244A1.245,1.245,0,0,0,2,4.731V8.462A1.245,1.245,0,0,0,3.244,9.706H8.218v8.706H9.462V9.706h4.46a1.235,1.235,0,0,0,.881-.364L17.546,6.6Zm-.881,4.61H3.244V4.731H13.922L15.787,6.6Z"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from '../../../Components/FormBuilder/Icons/IconBase'
export default {
  name: 'ExitSignIcon',
  components: { IconBase },
  props: iconProps
}
</script>

<style scoped>

</style>
