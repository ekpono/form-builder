<template>
  <div class="flex justify-between border-b px-3 pt-4 pb-2">
    <div class="text-navy font-bold text-sm">
      {{ title }}
    </div>
    <div class="flex gap-1">
      <span
        class="inline-block w-5 h-5 bg-gray-500 rounded-full text-white flex items-center justify-center mt-1 cursor-pointer select-none hover:bg-blue-600"
        @click="changeView(-1)"
      >
        <ArrowLeftIcon class="h-3 w-3 mx-auto" />
      </span>
      <span
        class="inline-block w-5 h-5 bg-gray-500 rounded-full text-white flex items-center justify-center mt-1 cursor-pointer select-none hover:bg-blue-600"
        @click="changeView(1)"
      >
        <ArrowRightIcon class="h-3 w-3 mx-auto" />
      </span>
    </div>
  </div>
</template>

<script>
import {
  ADD_EMOJI, CENTRAL_PART_COMPONENTS, DESIGN_THEME,
  FORM_TRANSFER, HYPERLINK,
  LOGIC_JUMP, MERGE_TAGS,
  QUESTION_SETTINGS, RECALL_INFO, STORE_ANSWER
} from '@/constants/Forms/centralPartViews'
import { ArrowLeftIcon, ArrowRightIcon } from '@heroicons/vue/solid'

export default {
  name: 'CentralPartHeader',
  components: {
    ArrowLeftIcon, ArrowRightIcon
  },
  props: {
    view: { type: String, default: null }
  },
  emits: ['update:centralPartView'],
  computed: {
    title: function () {
      return {
        [QUESTION_SETTINGS]: 'Question settings',
        [LOGIC_JUMP]: 'Logic jump',
        [FORM_TRANSFER]: 'Form transfer',
        [ADD_EMOJI]: 'Add emoji',
        [HYPERLINK]: 'Hyperlink',
        [RECALL_INFO]: 'Recall info',
        [MERGE_TAGS]: 'Merge tags',
        [STORE_ANSWER]: 'Store Answer',
        [DESIGN_THEME]: 'Design Theme'
      }[this.view] || 'Question Settings'
    }
  },
  methods: {
    changeView: function (offset) {
      let newViewPos = CENTRAL_PART_COMPONENTS.indexOf(this.view) + offset
      if (newViewPos < 0) {
        newViewPos = CENTRAL_PART_COMPONENTS.length - 1
      }
      if (newViewPos > CENTRAL_PART_COMPONENTS.length - 1) {
        newViewPos = 0
      }
      this.$emit('update:centralPartView', CENTRAL_PART_COMPONENTS[newViewPos])
    }
  }
}
</script>

<style scoped>

</style>
