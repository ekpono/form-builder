<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 1000 1000"
  >
    <g><path d="M10,762.5h619.8c13.5-30.9,44.4-52.5,80.2-52.5s66.6,21.6,80.2,52.5H990v70H790.2C776.6,863.4,745.8,885,710,885s-66.6-21.6-80.2-52.5H10" /><path d="M10,465h199.8c13.5-30.9,44.4-52.5,80.2-52.5c35.8,0,66.6,21.6,80.2,52.5H990v70H370.2c-13.5,30.9-44.4,52.5-80.2,52.5c-35.8,0-66.6-21.6-80.2-52.5H10" /><path d="M10,167.5h619.8c13.5-30.9,44.4-52.5,80.2-52.5s66.6,21.6,80.2,52.5H990v70H790.2C776.6,268.4,745.8,290,710,290s-66.6-21.6-80.2-52.5H10" /></g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'ControlsIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>

</style>
