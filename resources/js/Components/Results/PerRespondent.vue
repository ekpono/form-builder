<template>
  <div class="flex h-full relative overflow-hidden">
    <div
      class="overflow-y-auto w-full duration-300"
      :class="{'bg-gray-100': currentAnswer !== null}"
    >
      <div
        v-for="(a, i) in answers"
        :key="`results-answers-${a.form_uuid}-${a.order_uuid}`"
        class="border-b border-gray-200 py-3 px-5 duration-200"
        :class="[currentAnswer === i ? 'bg-blue-100 font-bold': 'hover:bg-gray-300 cursor-pointer']"
        @click="handleClickRespondent(i)"
      >
        <div>
          {{ moment(a.created_at).format('DD MMM') }}
          #{{ a.order.external_id }}
        </div>
        <div class="text-sm text-gray-600 font-normal">
          {{ a.order.store.domain }}
        </div>
      </div>
    </div>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform translate-x-full"
      enter-to-class="transform translate-x-0"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform translate-x-0"
      leave-to-class="transform translate-x-full"
    >
      <div
        v-show="currentAnswer !== null"
        class="w-10/12 absolute top-0 bottom-0 right-0 bg-white py-5 px-6 shadow-lg overflow-y-auto"
      >
        <div
          v-for="(a, index) in currentAnswers"
          :key="`results-answers-answer-${a.questionId}`"
        >
          <div class="flex gap-4">
            <div>
              <div class="bg-kick_off px-4 py-1 rounded font-bold">
                Q{{ index + 1 }}
              </div>
            </div>
            <div class="py-1 border-b border-gray-100">
              <div>{{ question(a.questionId)?.title }}</div>
              <div
                v-for="answer in a.answers"
                :key="`results-answers-answer-variant-${answer.id}`"
                class="py-3 font-bold"
              >
                {{ answer.value }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import { PURCHASED_ITEMS_CHOICE_QUESTION, QUESTION_TYPE_PURCHASED_ITEMS_CHOICE } from '../../constants/Forms/questions'
import moment from 'moment'

export default {
  name: 'PerRespondent',
  props: {
    questions: { type: Array, required: true },
    answers: { type: Array, required: true }
  },
  data () {
    return {
      currentAnswer: null
    }
  },
  computed: {
    currentAnswers: function () {
      return this.answers[this.currentAnswer]?.answers
    }
  },
  methods: {
    moment,
    handleClickRespondent: function (index) {
      this.currentAnswer = index
    },
    question: function (id) {
      if (id === QUESTION_TYPE_PURCHASED_ITEMS_CHOICE) {
        return PURCHASED_ITEMS_CHOICE_QUESTION
      }

      return this.questions.find(q => q.id === id)
    }
  }
}
</script>

<style scoped>

</style>
