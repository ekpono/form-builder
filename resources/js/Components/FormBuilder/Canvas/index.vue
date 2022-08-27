<template>
  <div
    class="h-full bg-white bg-[#F8F8F8] overflow-y-auto"
  >
    <div class="relative z-10 pt-6 pb-8 px-4">
      <FlowChart
        v-show="showFlowChart"
        class="absolute z-0 left-0 top-0 bottom-0 right-0"
        :questions="questionsCoordinates"
        :answers="answersCoordinates"
      />
      <div
        v-for="question in kickOffs"
        :key="`canvas-question-${question.id}`"
        :ref="question.id"
        class="relative z-10 pr-10 grid grid-cols-2"
      >
        <Question
          :question="question"
          :logic="logicByQuestionId(question.id)"
          :questions="questions"
          :first-row="true"
          @update:answers-coordinates="handleUpdateAnswersCoordinates"
          @click:go-to-logic-jump="$emit('click:goToLogicJump', $event)"
          @click="$emit('update:currentQuestion', question)"
        />
        <div
          v-if="questionsToForm[question.id]"
          :ref="questionsToForm[question.id]"
        >
          <FormTransfer
            :question-id="question.id"
            :form-id="getFormId(questionsToForm[question.id], question.id)"
            :first-row="true"
            @update:go-to-form-transfer="$emit('update:goToFormTransfer', $event)"
          />
        </div>
      </div>
      <div
        v-for="(followUpsQ, i) in followUps"
        :key="`follow-ups-row-${i}`"
      >
        <div
          :class="{
            grid: followUpsQ.length > 2,
            'grid-cols-2': followUpsQ.length === 4,
            'grid-cols-3': followUpsQ.length > 2 && followUpsQ.length !== 4
          }"
        >
          <div
            v-for="question in followUpsQ"
            :key="`canvas-question-${question.id}`"
            :ref="question.id"
            class="relative z-10 pr-10 grid grid-cols-2"
          >
            <Question
              :question="question"
              :logic="logicByQuestionId(question.id)"
              :questions="questions"
              @update:answers-coordinates="handleUpdateAnswersCoordinates"
              @click:go-to-logic-jump="$emit('click:goToLogicJump', $event)"
              @click="$emit('update:currentQuestion', question)"
            />
            <div
              v-if="questionsToForm[question.id]"
              :ref="questionsToForm[question.id]"
            >
              <FormTransfer
                :question-id="question.id"
                :form-id="getFormId(questionsToForm[question.id], question.id)"
                @update:go-to-form-transfer="$emit('update:goToFormTransfer', $event)"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="flex">
        <div
          v-for="question in typs"
          :key="`canvas-question-${question.id}`"
          :ref="question.id"
          class="relative z-10 pr-10"
        >
          <Question
            :question="question"
            :logic="logicByQuestionId(question.id)"
            :questions="questions"
            @update:answers-coordinates="handleUpdateAnswersCoordinates"
            @click:go-to-logic-jump="$emit('click:goToLogicJump', $event)"
            @click="$emit('update:currentQuestion', question)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FlowChart from '../../../Components/FormBuilder/Canvas/FlowChart'
import Question from '../../../Components/FormBuilder/Canvas/Question'
import FormTransfer from '../../../Components/FormBuilder/Canvas/FormTransfer'
import {
  QUESTION_CATEGORY_FOLLOW_UP,
  QUESTION_CATEGORY_KICK_OFF,
  QUESTION_CATEGORY_TYP
} from '../../../constants/Forms/questions'

export default {
  name: 'Canvas',
  components: { FormTransfer, FlowChart, Question },
  props: {
    questions: { type: Array, required: true },
    logic: { type: Array, required: true }
  },
  emits: ['click:goToLogicJump', 'update:goToFormTransfer', 'update:currentQuestion'],
  data: function () {
    return {
      answersCoordinates: [],
      questionsCoordinates: {},
      questionsToForm: {},
      showFlowChart: false
    }
  },
  computed: {
    kickOffs: function () {
      return this.questions.filter(q => q.category === QUESTION_CATEGORY_KICK_OFF)
    },
    followUps: function () {
      const questionRows = []
      let row = 0
      this.questions.filter(q => q.category === QUESTION_CATEGORY_FOLLOW_UP).forEach(q => {
        if (this.questionsToForm[q.id]) {
          row++
        }
        questionRows[row] = [...(questionRows[row] || []), q]
      })
      return questionRows
    },
    typs: function () {
      return this.questions.filter(q => q.category === QUESTION_CATEGORY_TYP)
    }
  },
  mounted () {
    this.questionsCoordinates = this.calculateQuestionsCoordinates()
    setTimeout(() => {
      this.questionsCoordinates = this.calculateQuestionsCoordinates()
      this.showFlowChart = true
    }, 500)
  },
  methods: {
    logicByQuestionId: function (id) {
      return this.logic.filter(l => l.question_id === id) || []
    },
    handleUpdateAnswersCoordinates: function (qId, coords) {
      const qRef = this.$refs[qId][0]
      this.answersCoordinates = this.answersCoordinates.filter(c => c.qId !== qId)
      coords.forEach(([x, y, toId, toForm]) => {
        if (toForm) {
          this.questionsToForm[qId] = toId
        }
        this.answersCoordinates.push({ x: qRef.offsetLeft + x, y: qRef.offsetTop + y, toId, toForm, qId })
      })
    },
    calculateQuestionsCoordinates: function () {
      return Object.fromEntries(
        Object.keys(this.$refs)
          .map(r => [
            r,
            {
              x1: this.$refs[r][0].offsetLeft + (r.indexOf('form') === 0 ? this.$refs[r][0].parentNode.offsetLeft : 0),
              x2: this.$refs[r][0].offsetLeft + this.$refs[r][0].offsetWidth + (r.indexOf('form') === 0 ? this.$refs[r][0].parentNode.offsetLeft : 0),
              y: this.$refs[r][0].offsetTop + 10 + (r.indexOf('form') === 0 ? this.$refs[r][0].parentNode.offsetTop : 0),
              index: this.questions.find(q => q.id === r)?.index || r
            }
          ])
      )
    },
    getFormId: function (idSting, qId) {
      return parseInt(idSting.replace('form-', '').replace(`${qId}-`, ''))
    }
  }
}
</script>

<style scoped>
</style>
