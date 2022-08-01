<template>
  <div>
    <div
      class="border-b-2 border-red-700 text-2xl leading-8 py-3 text-input"
      contenteditable="true"
      :placeholder="properties.placeholder"
      @input="handleChangeAnswer"
    >
      {{ answer }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'Open',
  props: {
    properties: { type: Object, required: true },
    initValue: { type: Array, default: () => ([]) }
  },
  emits: ['update:value'],
  data: function () {
    return { answer: (this.initValue[0] && this.initValue[0].value) || '' }
  },
  methods: {
    handleChangeAnswer: function (e) {
      this.$emit('update:value', [{ value: e.target.innerText }])
    }
  }
}
</script>

<style scoped>
.text-input {
    min-height: 58px;
}
</style>
