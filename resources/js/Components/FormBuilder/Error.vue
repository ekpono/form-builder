<template>
  <div
    class="text-red-500 flex gap-2 items-center"
  >
    <ExclamationIcon class="h-8" />
    <div class="font-italic text-xs">
      <slot />
    </div>
  </div>
</template>

<script>
import { ExclamationIcon } from '@heroicons/vue/solid'

export default {
  name: 'Error',
  components: {
    ExclamationIcon
  }
}
</script>

<style scoped>

</style>
