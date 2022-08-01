<template>
  <component
    :is="is"
    class="relative"
  >
    <div
      class="flex items-center question-list-item bg-gray-400 py-1 px-1 text-xs border border-gray-600 rounded mt-1 cursor-pointer h-8"
      :class="`bg-${category}`"
      @click="$emit('click')"
    >
      <QuestionLabel>
        <strong>?</strong> <small>{{ iconLetter }}{{ index }}</small>
      </QuestionLabel>
      <div class="w-2/3 ml-3 truncate">
        {{ title || 'No title' }}
      </div>
    </div>
    <button
      id="questionContextMenuButton"
      class="absolute right-0.5 top-0 bottom-0"
      @click="handleClickOptions"
    >
      <DotsVerticalIcon class="text-gray-500 w-4" />
    </button>
  </component>
</template>

<script>
import QuestionLabel from './QuestionLabel.vue'
import { QUESTION_CATEGORY_TYP } from '@/constants/Forms/questions'
import { DotsVerticalIcon } from '@heroicons/vue/outline'

export default {
  name: 'ListOfQuestionsItem',
  components: {
    QuestionLabel,
    DotsVerticalIcon
  },
  props: {
    title: String,
    type: String,
    index: Number,
    category: String,
    is: { type: String, default: 'div' }
  },
  emits: ['click', 'clickOptions'],
  computed: {
    iconLetter: function () {
      return this.category === QUESTION_CATEGORY_TYP ? 'TYP' : 'Q'
    }
  },
  methods: {
    handleClickOptions: function (event) {
      this.$emit(
        'clickOptions',
        event.path[0].getBoundingClientRect().top - event.path.find(e => e.id === 'workspace').offsetTop + window.scrollY - 20
      )
    }
  }
}
</script>

<style scoped>
  .question-list-item.kick_off {
    background: #EEC85E;
  }
  .question-list-item.typ {
    background: #50D66A;
  }
  .question-list-item.follow_up {
      background: #BFBFBF;
  }
</style>
