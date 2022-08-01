<template>
  <div class="flex gap-4 items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight w-1/2">
      «{{ form.name }}» {{ title }}
    </h2>
    <div class="flex items-center justify-between w-1/2">
      <div class="flex gap-3">
        <Link
          :href="route('form.builder.show', form.id)"
          class="text-sm text-gray-700 underline"
          :class="{ 'no-underline': $page.component === 'FormBuilder/Form' }"
        >
          Builder
        </Link>
        <Link
          :href="route('results.show', form.id)"
          class="text-sm text-gray-700 underline"
          :class="{ 'no-underline': $page.component === 'Results/Summary' }"
        >
          Summary
        </Link>
        <Link
          :href="route('results.responses', form.id)"
          class="text-sm text-gray-700 underline"
          :class="{ 'no-underline': $page.component === 'Results/Responses' }"
        >
          Responses
        </Link>
      </div>
      <div>
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link
  },
  props: {
    form: { type: Object, required: true },
    title: { type: String, required: true }
  }
}
</script>

<style scoped>

</style>
