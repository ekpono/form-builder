<template>
  <div class="text-xs text-navy">
    <div class="flex justify-between">
      <span>
        <slot />
      </span>
      <div>
        <Input
          type="number"
          class="h-6 w-16 pl-1 pr-0 text-xxs text-gray-600"
          :min="1"
          :model-value="modelValue"
          @update:modelValue="$emit('update:modelValue', $event)"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Input from '../../Components/Input'
export default {
  name: 'SettingInputNumber',
  components: { Input },
  props: { modelValue: { type: [String, Number], default: '' } },
  emits: ['update:modelValue']
}
</script>

<style scoped>

</style>
