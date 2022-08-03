<template>
  <div class="fixed left-0 top-0 bottom-0 right-0 z-50 bg-gray-200 flex flex-col gap-4">
    <div class="shadow p-3 text-gray-500 flex bg-white">
      <div class="font-semibold flex-grow text-center">
        Live Preview
      </div>
      <button @click="$emit('click:close')">
        <XIcon class="h-6 w-6 hover:text-blue-600" />
      </button>
    </div>
    <div
      ref="previewWindow"
      class="overflow-hidden"
    >
      <div
        class="mx-auto preview-window shadow-lg rounded bg-white overflow-y-auto"
        :class="{mobile: mobilePreview}"
        :style="previewWindowStyle"
      >
        <PreviewQuestion
          v-if="type === PREVIEW_TYPE_QUESTION"
          :question="question"
          :form-category="formCategory"
          :mobile-preview="mobilePreview"
        />
        <PreviewForm
          v-if="type === PREVIEW_TYPE_FORM"
          :form="form"
          :form-name="formName"
          :form-category="formCategory"
          :mobile-preview="mobilePreview"
        />
      </div>
    </div>
    <div class="pb-5 text-white text-sm text-center">
      <button
        class="px-5 py-1.5 rounded-l"
        :class="[mobilePreview ? 'bg-blue-800' : 'bg-blue-600']"
        @click="setMobilePreview(false)"
      >
        Desktop
      </button>
      <button
        class="px-5 py-1.5 rounded-r"
        :class="[mobilePreview ? 'bg-blue-600' : 'bg-blue-800']"
        @click="setMobilePreview(true)"
      >
        Mobile
      </button>
    </div>
  </div>
</template>

<script>
import { XIcon } from '@heroicons/vue/outline'
import { PREVIEW_TYPE_FORM, PREVIEW_TYPE_QUESTION } from '../../../constants/Forms/form'
import PreviewQuestion from '../../../Components/FormBuilder/preview/PreviewQuestion'
import PreviewForm from '../../../Components/FormBuilder/preview/PreviewForm'

const DESKTOP_HEIGHT = 800
const MOBILE_HEIGHT = 812

export default {
  name: 'Preview',
  components: {
    PreviewForm,
    PreviewQuestion,
    XIcon
  },
  props: {
    question: { type: Object, default: null },
    formCategory: { type: String, required: true },
    form: { type: Object, default: null },
    type: { type: String, required: true },
    formName: { type: String, required: true }
  },
  emits: ['click:close'],
  data: function () {
    return {
      mobilePreview: false,
      PREVIEW_TYPE_QUESTION,
      PREVIEW_TYPE_FORM,
      previewWindowHeight: 800,
      previewWindowWidth: 1280
    }
  },
  computed: {
    scale () {
      return this.previewWindowHeight / (this.mobilePreview ? MOBILE_HEIGHT : DESKTOP_HEIGHT)
    },
    previewWindowStyle () {
      return ({
        '--scale': this.scale
      })
    }
  },
  unmounted () {
    removeEventListener('resize', this.handleResize)
  },
  mounted () {
    addEventListener('resize', this.handleResize)
    this.countPreviewWindowSize()
  },
  methods: {
    setMobilePreview: function (val) {
      this.mobilePreview = val
    },
    handleResize: function () {
      this.countPreviewWindowSize()
    },
    countPreviewWindowSize: function () {
      this.previewWindowHeight = this.$refs.previewWindow.clientHeight
      this.previewWindowWidth = this.$refs.previewWindow.clientWidth
    }
  }
}
</script>

<style scoped>
.left-side {
    background: #1C1C1C;
}
.preview-window {
    /*aspect-ratio: 16 / 9;*/
    height: 800px;
    width: 1280px;
    transform-origin: 0 0;
    transform: scale(var(--scale));
}
.preview-window.mobile {
    /*aspect-ratio: 9 / 16;*/
    height: 812px;
    width: 375px;
}
@media (min-width: 1200px) {
    .preview-window {
        transform-origin: 50% 0;
    }
}
</style>
