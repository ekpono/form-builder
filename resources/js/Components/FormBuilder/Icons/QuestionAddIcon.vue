<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 8.848 11.219"
  >
    <g transform="translate(-19.374 -10.551)">
      <g transform="translate(14.124 9.294)">
        <path
          class="cls-1"
          d="M5.25,6.033H6.57A1.277,1.277,0,0,1,7.93,4.649,1.161,1.161,0,0,1,9.243,5.817c0,.635-.374.927-.965,1.371A2.277,2.277,0,0,0,7.11,9.175l.007.463H8.424V9.283c0-.718.273-.927,1.01-1.486a2.44,2.44,0,0,0,1.244-2.056C10.678,4.23,9.4,3.5,8,3.5c-1.326,0-2.786.647-2.754,2.533Zm1.562,5.516a.942.942,0,0,0,1.01.927.938.938,0,1,0,0-1.867A.94.94,0,0,0,6.812,11.549Z"
        />
      </g>
      <g transform="translate(-26.972 -296.199)">
        <g transform="translate(52 307)">
          <path
            class="cls-2"
            d="M8,3.5V6.443"
            transform="translate(-6.528 -3.5)"
          />
          <path
            class="cls-2"
            d="M6.443,8H3.5"
            transform="translate(-3.5 -6.528)"
          />
        </g>
      </g>
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'QuestionIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
  .cls-1 {
    fill: #050038;
  }

  .cls-2 {
    fill: none;
    stroke: #050038;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 0.5px;
  }
</style>
