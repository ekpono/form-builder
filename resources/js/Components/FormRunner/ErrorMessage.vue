<template>
  <div class="error-message py-3 text-xl">
    <slot />
  </div>
</template>

<script>
export default {
  name: 'ErrorMessage'
}
</script>

<style scoped>
.error-message {
    color: #CB4B0B;
}
</style>
