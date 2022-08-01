<template>
  <div class="bg-white overflow-hidden shadow rounded-lg"
  >
    <div class="p-5">
      <h5 class="mb-4 w-40 font-semibold">
        {{ metric.title }}
      </h5>
      <div
        v-for="(data, index) in metric.metrics"
        :key="index"
        class="border-b mb-3 flex items-center justify-between w-full border-gray-200"
      >
        <span class="font-light text-navy text-xs">{{ data.year }}</span>
        <div>
          <span class="text-2xl font-medium">{{ data.stat }}</span> <span class="text-gray-400 text-xs font-semibold">{{ data.val }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AppCardMetric',
  props: {
    metric: {
      type: Object,
      required: true
    }
  }
}
</script>

<style></style>