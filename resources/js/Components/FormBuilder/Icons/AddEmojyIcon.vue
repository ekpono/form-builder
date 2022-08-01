<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 30.506 30.506"
  >
    <g transform="translate(0.25 0.25)">
      <g transform="translate(0 4.48)">
        <path
          class="cls-1"
          d="M12.763,23.93A11.167,11.167,0,1,0,1.6,12.763,11.167,11.167,0,0,0,12.763,23.93Zm0,1.6A12.763,12.763,0,1,0,0,12.763,12.763,12.763,0,0,0,12.763,25.525Z"
        />
        <path
          class="cls-1"
          d="M9.477,21.482a.8.8,0,0,1,1.09.292,5.586,5.586,0,0,0,9.674,0,.8.8,0,1,1,1.381.8,7.181,7.181,0,0,1-12.437,0,.8.8,0,0,1,.292-1.09Z"
          transform="translate(-2.641 -6.219)"
        />
        <path
          class="cls-2"
          d="M14.441,13.643c0,1.321-.715,2.393-1.6,2.393s-1.6-1.072-1.6-2.393.715-2.393,1.6-2.393S14.441,12.322,14.441,13.643Zm6.381,0c0,1.321-.715,2.393-1.6,2.393s-1.6-1.072-1.6-2.393.715-2.393,1.6-2.393S20.822,12.322,20.822,13.643Z"
          transform="translate(-3.273 -3.273)"
        />
      </g>
      <g
        id="plus"
        transform="translate(21.046)"
      >
        <path
          class="cls-1"
          d="M12.355,7.875a.5.5,0,0,1,.5.5v3.982a.5.5,0,0,1-.5.5H8.373a.5.5,0,0,1,0-1h3.484V8.373A.5.5,0,0,1,12.355,7.875Z"
          transform="translate(-7.875 -7.875)"
        />
        <path
          class="cls-1"
          d="M16.875,17.373a.5.5,0,0,1,.5-.5h3.982a.5.5,0,1,1,0,1H17.871v3.484a.5.5,0,1,1-1,0Z"
          transform="translate(-12.893 -12.893)"
        />
      </g>
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'AddEmojyIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
.cls-1, .cls-2 {
  fill: #050038;
  stroke: #050038;
  stroke-width: 0.5px;
}

.cls-1 {
  fill-rule: evenodd;
}
</style>
