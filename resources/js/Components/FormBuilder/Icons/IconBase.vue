<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :width="width"
    :height="height"
    :viewBox="viewBox"
  >
    <g :fill="iconColor">
      <slot />
    </g>
  </svg>
</template>

<script>
export const iconProps = {
  width: {
    type: [Number, String],
    default: 18
  },
  height: {
    type: [Number, String],
    default: 18
  },
  iconColor: {
    type: String,
    default: '#050038'
  },
  viewBox: {
    type: String,
    default: '0 0 18 18'
  }
}
export default {
  name: 'IconBase',
  props: iconProps
}
</script>

<style scoped>
svg {
  display: inline-block;
  vertical-align: center;
}
</style>
