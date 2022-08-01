<template>
  <div class="px-3 py-2 relative">
    <div
      v-for="setting in colors"
      :key="`design-theme-color-${setting}`"
      class="flex justify-between text-sm text-gray-600 py-1"
    >
      <div class="capitalize">
        {{ setting.replace('_', ' ') }}
      </div>
      <div
        class="h-5 w-12 rounded border"
        :style="{background: theme[setting]}"
        @click="showPicker = setting"
      />
    </div>
    <div
      v-if="showPicker"
      class="absolute top-1 left-1 right-1 z-10 px-3 py-2 bg-white rounded shadow"
    >
      <div class="overflow-hidden py-1">
        <XIcon
          class="h-6 text-gray-500 hover:text-gray-700 duration-300 float-right cursor-pointer"
          @click="showPicker = null"
        />
      </div>
      <ColorPicker
        style="width: 100%"
        :pureColor="theme[showPicker]"
        pickerType="chrome"
        format="hex"
        @pureColorChange="handleChangeColor"
      />
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline'
import { ColorPicker } from "vue3-colorpicker";

export default {
  name: 'DesignTheme',
  components: {
    ColorPicker: ColorPicker,
    XIcon
  },
  props: {
    theme: {
      type: Object,
      default: () => ({
        questions: '#111111',
        descriptions: '#666666',
        answers: '#111111',
        buttons: '#d51920',
        button_text: '#ffffff',
        background: '#ffffff'
      })
    }
  },
  emits: ['update:theme'],
  data: function () {
    return {
      colors: ['questions', 'descriptions', 'answers', 'buttons', 'button_text', 'background'],
      showPicker: null
    }
  },
  methods: {
    handleChangeColor: function (c) {
      this.$emit('update:theme', { ...this.theme, [this.showPicker]: c })
    }
  }
}
</script>

<style scoped>
@import "vue3-colorpicker/style.css";
</style>
