<template>
  <div class="border rounded p-4 border-gray-200"
  >
    <img
      class="mx-auto"
      width="104"
      height="104"
      src="/vendor/form-builder/images/preview-comment.png"
      alt=""
    >
    <h5 class="my-3 text-xs font-semibold">
      {{ product.name }}
    </h5>
    <div class="flex items-center">
      <span class="text-xs mr-1 text-gray-400 font-extralight">Review Score:</span>
      <AppReviewsStarts
        width="w-3"
        height="h-3"
        :rating="product.rating"
      />
    </div>
    <div>
      <span class="text-xs text-gray-400 font-extralight">Reviews: {{ product.reviews }}</span>
    </div>
  </div>
</template>

<script>
import AppReviewsStarts from '../reviews/AppReviewsStarts.vue'
export default {
  name: 'AppProductFeed',
  components: {
    AppReviewsStarts
  },
  props: {
    product: {
      type: Object,
      required: true
    }
  }
}
</script>