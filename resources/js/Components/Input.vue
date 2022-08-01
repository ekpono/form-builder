<template>
  <input
    ref="input"
    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    :value="modelValue"
    :min="min"
    :disabled="disabled"
    :placeholder="placeholder"
    :required="required"
    :type="type || 'text'"
    @input="$emit('update:modelValue', $event.target.value)"
  >
</template>

<script>
export default {
  props: {
    modelValue: { type: [String, Number], default: '' },
    min: { type: Number, default: undefined },
    disabled: { type: Boolean, default: false },
    placeholder: { type: String, default: undefined },
    required: { type: Boolean, required: false },
    type: { type: String, default: 'text' }
  },

  emits: ['update:modelValue'],

  methods: {
    focus () {
      this.$refs.input.focus()
    }
  }
}
</script>
