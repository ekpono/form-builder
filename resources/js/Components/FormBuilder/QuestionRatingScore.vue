<template>
  <div class="flex gap-2 justify-between items-start pt-2">
    <div
      v-for="r in ratingBlocks"
      :key="`ratingBlocks${r}`"
      class="border border-gray-500 text-gray-600 rounded w-full text-center rating-block relative bg-gray-300 bg-opacity-60 hover:bg-opacity-90 transition-all cursor-pointer"
    >
      <div class="absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center rounded pointer-events-none">
        {{ r }}
      </div>
    </div>
  </div>
  <div class="flex gap-2 py-2">
    <div class="text-xs text-gray-500 w-1/3">
      {{ properties.label_left }}
    </div>
    <div class="text-xs text-gray-500 w-1/3 text-center">
      {{ properties.label_middle }}
    </div>
    <div class="text-xs text-gray-500 w-1/3 text-right">
      {{ properties.label_right }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'QuestionRatingScore',
  props: {
    properties: {
      type: Object,
      default: () => ({
        from: { type: [String, Number], default: 1 },
        to: { type: [String, Number], default: 5 },
        label_left: { type: String, default: '' },
        label_middle: { type: String, default: '' },
        label_right: { type: String, default: '' }
      })
    }
  },
  emits: ['update:properties', 'spyCaret'],
  setup: function (props, ctx) {
    if (!props.properties.from || !props.properties.to) {
      ctx.emit(
        'update:properties',
        { ...props.properties.properties, from: props.properties.from || 1, to: props.properties.to || 5 }
      )
    }
  },
  computed: {
    ratingBlocks: function () {
      return Array((this.properties.to || 5) - (this.properties.from || 1) + 1).fill(0, 0)
        .map((_, index) => +(this.properties.from || 1) + index)
    }
  },
  updated: function () {
    if (!this.properties.from || !this.properties.to) {
      this.$emit(
        'update:properties',
        { ...this.properties, from: this.properties.from || 1, to: this.properties.to || 5 }
      )
    }
  }
}
</script>

<style scoped>
.rating-block:after {
    content: '';
    display: block;
    padding-bottom: 100%;
}
</style>
