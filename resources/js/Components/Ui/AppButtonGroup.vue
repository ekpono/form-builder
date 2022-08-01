<template>
  <div>
    <p class="text-navy text-xs mb-2 text-center">
      {{ title }}
    </p>
    <span class="relative z-0 inline-flex shadow-sm rounded-full">
      <button
        v-for="(option, index) in options"
        :key="index"
        :value="option.value"
        type="button"
        :class="[option.rounded]"
        class="text-2xs relative inline-flex items-center px-6 py-2 border border-gray-300 bg-white text-sm font-light text-gray-400 hover:bg-gray-50 focus:z-10 focus:outline-none focus:bg-indigo-500 focus:text-white"
      >
        {{ option.text }}
      </button>
    </span>
  </div>
</template>

<script>
export default {
  name: 'AppButtonGroup',
  props: {
    title: {
      type: String,
      required: true
    },
    options: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
  .text-2xs {
    font-size: .60rem;
  }
</style>
