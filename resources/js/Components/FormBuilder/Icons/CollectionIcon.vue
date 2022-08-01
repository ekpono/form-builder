<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 31.357 27.5"
  >
    <g transform="translate(0.25 0.25)">
      <path
        class="cls-1"
        d="M27.964,26.2H2.893a.964.964,0,0,1-.964-.964v-13.5a.964.964,0,0,1,.964-.964H27.964a.964.964,0,0,1,.964.964v13.5A.964.964,0,0,1,27.964,26.2ZM2.893,28.125A2.893,2.893,0,0,1,0,25.232v-13.5A2.893,2.893,0,0,1,2.893,8.839H27.964a2.893,2.893,0,0,1,2.893,2.893v13.5a2.893,2.893,0,0,1-2.893,2.893ZM3.857,5.946a.964.964,0,0,0,.964.964H26.036a.964.964,0,0,0,0-1.929H4.821A.964.964,0,0,0,3.857,5.946ZM7.714,2.089a.964.964,0,0,0,.964.964h13.5a.964.964,0,0,0,0-1.929H8.679a.964.964,0,0,0-.964.964Z"
        transform="translate(0 -1.125)"
      />
    </g>
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'CollectionIcon',
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
