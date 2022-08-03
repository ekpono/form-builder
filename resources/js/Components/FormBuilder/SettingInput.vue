<template>
  <div class="text-xs text-navy">
    <div class="flex justify-between">
      <span>
        <slot />
      </span>
      <div>
        <Input
          type="text"
          class="h-6 w-32 pl-1 pr-0 text-xxs text-gray-600"
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
  name: 'SettingInput',
  components: { Input },
  props: { modelValue: { type: [String, Number], default: '' } },
  emits: ['update:modelValue']
}
</script>

<style scoped>

</style>
