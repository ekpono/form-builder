<template>
  <icon-base
    v-bind="$props"
    viewBox="0 0 21 27"
  >
    <path
      d="M9,28.5a3,3,0,0,0,3,3H24a3,3,0,0,0,3-3v-18H9v18m3-15H24v15H12v-15M23.25,6l-1.5-1.5h-7.5L12.75,6H7.5V9h21V6Z"
      transform="translate(-7.5 -4.5)"
    />
  </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
  name: 'TrashIcon',
  components: {
    IconBase
  },
  props: iconProps
}
</script>

<style scoped>
</style>
