<template>
  <div class="overflow-hidden">
    <div class="bg-white overflow-hidden">
      <ChevronDoubleLeftIcon
        v-if="isCanvas"
        class="h-5 text-gray-500 hover:text-gray-700 duration-300 float-right cursor-pointer my-2 pr-1"
        @click="$emit('click:close')"
      />
      <XIcon
        v-else
        class="h-6 text-gray-500 hover:text-gray-700 duration-300 float-right cursor-pointer"
        @click="$emit('click:close')"
      />
    </div>
    <div class="overflow-y-auto h-full">
      <CentralPartHeader
        v-if="!isCanvas"
        :view="view"
        @update:centralPartView="$emit('update:centralPartView', $event)"
      />
      <component
        :is="centralPartComponent"
        class="pb-20"
        :question="question"
        :question-category="questionCategory"
        :questions="questions"
        :logic="logic"
        :form-category="formCategory"
        :forms="forms"
        :theme="theme"
        @update:question="$emit('update:question', $event)"
        @update:questionCategory="$emit('update:questionCategory', $event)"
        @update:logic="$emit('update:logic', $event)"
        @update:currentQuestion="$emit('update:currentQuestion', $event)"
        @click:addMedia="$emit('click:addMedia')"
        @click:emoji="$emit('click:emoji', $event)"
        @update:addMark="$emit('update:addMark', $event)"
        @update:theme="$emit('update:theme', $event)"
        @click:go-to-logic-jump="$emit('update:goToLogicJump', $event)"
        @update:go-to-form-transfer="$emit('update:goToFormTransfer', $event)"
      />
    </div>
  </div>
</template>

<script>

import CentralPartHeader from '../../Components/FormBuilder/CentralPartHeader'
import { CANVAS, componentMap } from '../../constants/Forms/centralPartViews'
import { ChevronDoubleLeftIcon, XIcon } from '@heroicons/vue/solid'

export default {
  name: 'CentralPartView',
  components: { CentralPartHeader, XIcon, ChevronDoubleLeftIcon },
  props: {
    view: { type: String, default: null },
    questions: { type: Array, default: () => ([]) },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => ([]) },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' },
    theme: { type: Object, default: undefined }
  },
  emits: ['update:question', 'update:questionCategory', 'update:logic', 'update:currentQuestion', 'click:addMedia', 'click:emoji', 'update:addMark', 'update:centralPartView', 'update:theme', 'click:close', 'update:goToLogicJump', 'update:goToFormTransfer'],
  computed: {
    centralPartComponent: function () {
      return (componentMap[this.view] && componentMap[this.view]()) || null
    },
    isCanvas: function () {
      return this.view === CANVAS
    }
  }
}
</script>

<style scoped>

</style>
