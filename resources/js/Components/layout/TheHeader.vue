<template>
  <NavHeader @open-sidebar="$emit('open-sidebar', $event)" />
</template>

<script>
import NavHeader from './NavHeader.vue'
export default {
  name: 'TheHeader',
  components: {
    NavHeader
  },
  emits: ['open-sidebar']
}
</script>
