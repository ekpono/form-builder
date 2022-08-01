<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 27.5 27.5"
  >
    <g transform="translate(0.25 0.25)">
      <path
        class="cls-1"
        d="M28.961,5.432,26.068,2.539l-.675-.289H8.961L8,3.214V8.036H3.214L2.25,9V28.286l.964.964H22.5l.964-.964V23.464h4.821l.964-.964V6.107l-.289-.675Zm-7.425,21.89H4.179V9.964H6.107v5.92H17.679V9.964H19.2L21.536,12.3Zm-9.643-13.5V9.964H15.75v3.857Zm15.429,7.714H23.464V11.893l-.289-.675L20.283,8.325l-.675-.29H9.964V4.179H25.026L27.36,6.513Z"
        transform="translate(-2.25 -2.25)"
      />
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'SaveAllIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
.cls-1 {
  fill: #050038;
  stroke: #050038;
  stroke-width: 0.5px;
}
</style>
