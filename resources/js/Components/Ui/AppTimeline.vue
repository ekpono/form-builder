<template>
  <div class="rounded border mt-4 border-gray-300 p-4">
    <div class="flex items-center">
      <ChevronLeftIcon class="h-10 w-10 text-gray-300 cursor-pointer hover:text-gray-500" />
      <div class="mx-3 flex w-full justify-around text-center">
        <button
          v-for="(date, index) in months"
          :key="index"
          class="cursor-pointer bg-white text-xs p-3 rounded text-gray-400 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:text-indigo-500 focus:ring-indigo-500 focus:border-indigo-500"
        >
          <p>{{ date.month }}</p>
          <p>{{ date.year }}</p>
        </button>
      </div>
      <ChevronRightIcon class="h-10 w-10 text-gray-300 cursor-pointer hover:text-gray-500" />
    </div>
  </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/outline'
export default {
  name: 'AppTimeline',
  components: {
    ChevronLeftIcon,
    ChevronRightIcon
  },
  props: {
    months: {
      type: Array,
      required: true
    }
  }
}
</script>