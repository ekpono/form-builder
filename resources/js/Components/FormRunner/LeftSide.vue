<template>
  <div
    class="left-side flex flex-col items-center text-white h-10 px-4 overflow-y-auto"
    :class="{'justify-between': orderItem, 'justify-center': !orderItem, 'py-16': show, 'h-full': show, 'lg:h-full py-5 lg:py-16': !isMobile}"
    @click="toggle"
  >
    <transition-group
      enter-active-class="transition ease-out duration-300"
      enter-from-class="transform opacity-0 scale-50"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-50"
    >
      <div
        v-show="show"
        key="left-side-form-header"
      >
        <div
          v-if="orderItem"
          class="form-pre-name text-center"
        >
          Review the
        </div>
        <div class="form-name">
          {{ orderItem ? orderItem.name : formName }}
        </div>
      </div>
      <FormProgress
        v-if="orderItem && show"
        key="left-side-form-progress"
        :questions="questions"
        :current-question-id="currentQuestionId"
        :tags="tags"
      />
    </transition-group>
    <div>
      <div
        v-if="orderItem"
        class="text-center step font-medium absolute duration-300 left-0 right-0 lg:static"
        :class="[show ? 'bottom-16' : 'bottom-2']"
      >
        Question {{ indexOfCurrentQuestion + 1 }} of {{ questions.length }}
      </div>
    </div>
    <div
      v-if="isMobile"
      class="absolute right-2 duration-300"
      :class="[show ? 'bottom-16' : 'bottom-2']"
    >
      <ChevronDownIcon
        v-if="show"
        class="h-8"
      />
      <ChevronUpIcon
        v-else
        class="h-8"
      />
    </div>
  </div>
</template>

<script>

import FormProgress from '@/Components/FormRunner/FormProgress'
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
  name: 'LeftSide',
  components: {
    FormProgress,
    ChevronUpIcon,
    ChevronDownIcon
  },
  props: {
    formName: { type: String, required: true },
    formCategory: { type: String, required: true },
    questions: { type: Array, default: () => [] },
    orderItem: { type: Object, default: null },
    currentQuestionId: { type: String, default: null },
    tags: { type: Object, required: true },
    isMobile: { type: Boolean, required: true }
  },
  data () {
    return {
      show: !this.isMobile
    }
  },
  computed: {
    indexOfCurrentQuestion: function () {
      return this.questions.findIndex(q => q.id === this.currentQuestionId)
    }
  },
  watch: {
    isMobile: function () {
      this.show = !this.isMobile
    }
  },
  methods: {
    toggle: function () {
      this.show = this.isMobile ? !this.show : true
    }
  }
}
</script>

<style scoped>
.form-name {
    font-size: 32px;
}
.form-pre-name {
    font-size: 20px;
    line-height: 24px;
}
.left-side {
    background: #1C1C1C;
    transition: all .3s;
}
.step {
  font-size: 14px;
  line-height: 17px;
}
</style>
