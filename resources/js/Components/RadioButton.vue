<template>
  <div class="py-1">
    <label class="flex gap-2 text-navy cursor-pointer">
      <input
        type="radio"
        :name="name"
        class="hidden radio-input"
        :checked="modelValue"
        @change="$emit('update:modelValue', $event)"
      >
      <span class="radio inline-block border border-gray-500 rounded-full relative" />
      <span class="label-text">{{ label }}</span>
    </label>
  </div>
</template>

<script>
export default {
  name: 'RadioButton',
  props: {
    name: { type: String, required: true },
    label: { type: String, required: true },
    modelValue: { type: Boolean, default: false }
  },
  emits: ['update:modelValue']
}
</script>

<style scoped>
.label-text {
    font-size: 9px;
}
.radio-input + .radio {
    width: 13px;
    height: 13px;
}
.radio:before {
    content: '';
    margin: 2px 0 0 2px;
    display: block;
    background: #000;
    width: 7px;
    height: 7px;
    border-radius: 20px;
    opacity: 0;
    transition: all .3s;
}
.radio-input:checked + .radio:before {
    opacity: 1;
}
</style>
