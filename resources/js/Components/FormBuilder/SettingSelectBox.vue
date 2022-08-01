<template>
  <div class="text-xs text-navy">
    <div class="flex justify-between">
      <span>
        <slot />
      </span>
      <div>
        <SelectBox
          class="h-6 w-32"
          :model-value="modelValue"
          :items="items"
          @update:modelValue="$emit('update:modelValue', $event)"
        />
      </div>
    </div>
  </div>
</template>

<script>
import SelectBox from '@/Components/SelectBox'
export default {
  name: 'SettingSelectBox',
  components: { SelectBox },
  props: {
    modelValue: { type: [String, Number], default: '' },
    items: { type: Array, required: true }
  },
  emits: ['update:modelValue'],
  setup: function (props, ctx) {
    if (!props.modelValue) {
      ctx.emit('update:modelValue', props.items[props.items.length - 1]?.value + '')
    }
  }
}
</script>

<style scoped>

</style>
