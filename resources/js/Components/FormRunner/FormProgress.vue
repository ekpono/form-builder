<template>
  <div>
    <div
      v-for="(q, i) in questions"
      :key="`form-progress-question-${q.id}`"
      class="question py-2 flex gap-3 items-center"
      :class="[{ current: indexOfCurrentQuestion === i, passed: indexOfCurrentQuestion > i }] "
    >
      <div>{{ recallInfo(mergeTags(q.title, tags), []) }}</div>
      <ArrowNarrowRightIcon
        v-if="indexOfCurrentQuestion === i"
        class="h-5"
      />
    </div>
  </div>
</template>

<script>
import { mergeTags, recallInfo } from '../../forms'
import { ArrowNarrowRightIcon } from '@heroicons/vue/outline'

export default {
  name: 'FormProgress',
  components: {
    ArrowNarrowRightIcon
  },
  props: {
    questions: { type: Array, required: true },
    currentQuestionId: { type: String, default: undefined },
    tags: { type: Object, required: true }
  },
  computed: {
    indexOfCurrentQuestion: function () {
      return this.questions.findIndex(q => q.id === this.currentQuestionId)
    }
  },
  methods: {
    mergeTags,
    recallInfo
  }
}
</script>

<style scoped>
.question {
    font-size: 16px;
    line-height: 19px;
    color: #EEEEEE;
    opacity: 0.4000000059604645;
    font-weight: 600;
}
.question.current, .question.passed {
    opacity: 1;
}
.question.passed {
    color: #ccc;
    text-decoration: line-through;
}
</style>
