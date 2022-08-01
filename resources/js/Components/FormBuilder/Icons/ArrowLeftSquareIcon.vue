<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 27.5 27.5"
  >
    <g transform="translate(0.25 0.25)">
      <g
        data-name="arrow-left-square"
        transform="translate(27 27) rotate(180)"
      >
        <path
          id="Path_515"
          data-name="Path 515"
          class="cls-1"
          d="M23.625,1.688H3.375A1.687,1.687,0,0,0,1.688,3.375v20.25a1.688,1.688,0,0,0,1.687,1.688h20.25a1.688,1.688,0,0,0,1.688-1.687V3.375A1.688,1.688,0,0,0,23.625,1.688ZM3.375,0A3.375,3.375,0,0,0,0,3.375v20.25A3.375,3.375,0,0,0,3.375,27h20.25A3.375,3.375,0,0,0,27,23.625V3.375A3.375,3.375,0,0,0,23.625,0Z"
        />
        <path
          id="Path_516"
          data-name="Path 516"
          class="cls-1"
          d="M8.673,15.423a1.125,1.125,0,0,0,0-1.593L2.718,7.877,8.674,1.923A1.126,1.126,0,0,0,7.081.33L.331,7.08a1.125,1.125,0,0,0,0,1.593l6.75,6.75a1.125,1.125,0,0,0,1.593,0Z"
          transform="translate(6.749 5.623)"
        />
        <path
          id="Path_517"
          data-name="Path 517"
          class="cls-1"
          d="M13.5,1.125A1.125,1.125,0,0,0,12.375,0H1.125a1.125,1.125,0,0,0,0,2.25h11.25A1.125,1.125,0,0,0,13.5,1.125Z"
          transform="translate(7.425 12.375)"
        />
      </g>
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'ArrowLeftSquareIcon',
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
  fill-rule: evenodd;
}
</style>
