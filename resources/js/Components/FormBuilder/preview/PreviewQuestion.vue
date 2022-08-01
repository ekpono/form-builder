<template>
  <div
    class="flex h-full"
  >
    <div
      v-show="!mobilePreview"
      class="left-side py-5 lg:py-16 px-4 h-full"
      :class="{'w-1/2': !mobilePreview}"
    />
    <div
      :class="[mobilePreview ? 'px-5 w-full' : 'w-1/2 px-16']"
      class="py-16 flex flex-col justify-center"
    >
      <Question
        :question="question"
        :form-progress="[]"
        :form-category="formCategory"
        :is-mobile="mobilePreview"
      />
    </div>
  </div>
</template>

<script>
import Question from '@/Components/FormRunner/Question'

export default {
  name: 'PreviewQuestion',
  components: {
    Question
  },
  props: {
    question: { type: Object, default: null },
    formCategory: { type: String, required: true },
    mobilePreview: { type: Boolean, default: false }
  }
}
</script>

<style scoped>
.left-side {
    background: #1C1C1C;
}
.preview-window {
    aspect-ratio: 16 / 9;
}
.preview-window.mobile {
    aspect-ratio: 9 / 16;
}
</style>
