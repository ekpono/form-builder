<template>
  <div class="text-xs text-navy">
    <label class="flex justify-between">
      <span>
        <slot />
      </span>
      <Switch
        :model-value="modelValue"
        @update:modelValue="$emit('update:modelValue', $event)"
      />
    </label>
  </div>
</template>

<script>
import Switch from '../Switch.vue'

export default {
  name: 'SettingSwitch',
  components: {
    Switch
  },
  props: {
    modelValue: { type: Boolean, default: false }
  },
  emits: ['update:modelValue']
}
</script>

<style scoped>
</style>
