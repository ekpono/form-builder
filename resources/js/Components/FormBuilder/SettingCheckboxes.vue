<template>
  <div class="text-xs text-navy">
    <div class="flex justify-between">
      <span>
        <slot />
      </span>
      <div>
        <div
          v-for="o in settings.options"
          :key="`setting-checkboxes${o}`"
        >
          <label class="flex gap-1 items-center">
            <Checkbox
              class="h-3 w-3"
              style="border-radius: 0"
              :checked="modelValue.indexOf(o) !== -1"
              @update:checked="handleChange(o, $event)"
            />
            <span class="capitalize checkbox-label">{{ o }}</span>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Checkbox from '../../Components/Checkbox'
export default {
  name: 'SettingCheckboxes',
  components: { Checkbox },
  props: {
    settings: {
      type: Object,
      default: () => ({
        options: []
      })
    },
    modelValue: { type: Array, default: () => ['days'] }
  },
  emits: ['update:modelValue'],
  methods: {
    handleChange: function (option, checked) {
      const newValue = (checked ? [...this.modelValue, option] : this.modelValue.filter(o => o !== option)).filter((v, i, a) => a.indexOf(v) === i)
      if (newValue.length === 0) {
        return alert('You must choose at least one of the options')
      }
      this.$emit('update:modelValue', newValue)
    }
  }
}
</script>

<style scoped>
.checkbox-label {
    font-size: 9px;
}
</style>
