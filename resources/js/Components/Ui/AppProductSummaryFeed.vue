<template>
  <div class="flex items-center">
    <p class="w-32 mr-5 text-center font-semibold text-xs text-navy">
      {{ title }}
    </p>
    <div class="border rounded border-gray-200 flex-grow">
      <h2 class="font-semibold px-3 pt-4 pb-0">
        Product Summary Feed
      </h2>
      <div class="flex items-center justify-between">
        <ChevronLeftIcon class="h-10 w-10 text-gray-300 cursor-pointer hover:text-gray-500" />
        <div class="flex gap-4 p-5">
          <template
            v-for="(product, index) in products"
            :key="index"
          >
            <AppProductFeed :product="product" />
          </template>
        </div>
        <ChevronRightIcon class="h-10 w-10 text-gray-300 cursor-pointer hover:text-gray-500" />
      </div>
    </div>
  </div>
</template>

<script>
import AppProductFeed from './AppProductFeed.vue'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/outline'
export default {
  name: 'AppProductSummaryFeed',
  components: {
    AppProductFeed,
    ChevronLeftIcon,
    ChevronRightIcon
  },
  props: {
    title: {
      type: String,
      required: true
    },
    products: {
      type: Array,
      required: true
    }
  }
}
</script>