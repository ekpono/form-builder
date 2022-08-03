<template>
  <div
    v-if="question.category === QUESTION_CATEGORY_TYP"
    class="px-3 py-4"
  >
    <SelectBox
      label="From question"
      :items="questionSelectBoxItems"
      :model-value="question.id"
      classes="h-10"
      @update:modelValue="$emit('update:currentQuestion', { id: $event })"
    />
    <div class="text-gray-600 text-xs py-2">
      You can't add form transfer for thank you page
    </div>
  </div>
  <template v-if="question.category !== QUESTION_CATEGORY_TYP">
    <div class="px-3 pt-4 pb-2">
      <SelectBox
        label="Transfer question"
        :items="questionSelectBoxItems"
        :model-value="question.id"
        classes="h-10"
        @update:modelValue="$emit('update:currentQuestion', { id: $event })"
      />
    </div>
    <div
      v-for="(l, i) in questionTransfers"
      :key="`questionTransfer${i}`"
      class="border-b last:border-0"
    >
      <div class="px-3 py-4">
        <LogicJumpCondition
          v-for="(condition, conditionIndex) in l.conditions"
          :key="`transfer-from-condition-${conditionIndex}`"
          :first="conditionIndex === 0"
          :logic-op="condition.logic_op"
          :op="condition.op"
          :compare-with="condition.compare_with"
          :question-number="questionNumber"
          :question="question"
          :condition-index="conditionIndex"
          :logic-index="l.index"
          @update:op="handleUpdateCondition(l.index, conditionIndex, { op: $event })"
          @update:compareWith="handleUpdateCondition(l.index, conditionIndex, { compare_with: $event })"
          @update:logicOp="handleUpdateCondition(l.index, conditionIndex, { logic_op: $event })"
          @delete="handleDeleteCondition(l.index, conditionIndex)"
        />
        <button
          v-if="l.conditions && l.conditions[l.conditions.length - 1]?.op"
          class="bg-gray-600 py-1 px-2 text-white text-xxs rounded"
          @click="handleAddCondition(l.index)"
        >
          Add condition?
        </button>
        <div
          v-if="hasConditions(l.index)"
          class="flex justify-between pt-3"
        >
          <div class="text-xxs leading-3 text-gray-500">
            Then move respondent<br> over to form:
          </div>
          <div>
            <SelectBox
              style="width: 155px;"
              :items="formsSelectBoxItems"
              placeholder="Select form"
              :model-value="l.goto"
              :font-size="10"
              classes="h-9"
              @update:modelValue="handleChangeGoto(l.index, $event)"
            />
          </div>
        </div>
        <div
          v-if="hasConditions(l.index)"
          class="text-xxs leading-3 text-gray-500 pb-2 pt-5"
        >
          In ALL other instances, the respondent will<br> move to the next question in this form.
        </div>
      </div>
    </div>
    <div class="text-right px-3 py-3">
      <button
        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 gap-1 font-bold"
        @click="addFromTransfer"
      >
        {{ questionTransfers.length > 0 ? 'Add another form transfer' : 'Add form transfer' }}
      </button>
    </div>
  </template>
</template>

<script>
import { QUESTION_CATEGORY_KICK_OFF, QUESTION_CATEGORY_TYP } from '../../constants/Forms/questions'
import { TYPE_FORM_TRANSFER } from '../../constants/Forms/logicJump'
import SelectBox from '../../Components/SelectBox'
import LogicJumpCondition from '../../Components/FormBuilder/LogicJumpCondition'
import { updateArrayElement } from '../../functions'

export default {
  name: 'FormTransfer',
  components: { LogicJumpCondition, SelectBox },
  props: {
    questions: { type: Array, default: () => [] },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => [] },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }

  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic'],
  data: () => ({ QUESTION_CATEGORY_TYP }),
  computed: {
    questionSelectBoxItems: function () {
      return this.questions.map(q => ({
        value: q.id,
        title: `Q${q.index} - ` + (q.title || 'No title'),
        isKickOff: q.category === QUESTION_CATEGORY_KICK_OFF
      }))
    },
    formsSelectBoxItems: function () {
      return this.forms.map(f => ({ value: f.id, title: f.name }))
    },
    questionTransfers: function () {
      return this.logic.map((l, index) => ({ ...l, index })).filter(l => l.question_id === this.question.id && l.type === TYPE_FORM_TRANSFER)
    },
    questionNumber: function () {
      return this.questions.findIndex(q => q.id === this.question.id) + 1
    }
  },
  methods: {
    addFromTransfer: function () {
      this.$emit('update:logic', [...this.logic, { question_id: this.question.id, type: TYPE_FORM_TRANSFER, conditions: [{}] }])
    },
    handleAddCondition: function (index) {
      this.$emit(
        'update:logic',
        updateArrayElement(
          this.logic,
          index,
          l => ({
            ...l,
            conditions: [...(l.conditions || []), {}]
          })
        )
      )
    },
    handleUpdateCondition: function (index, conditionIndex, updates) {
      this.$emit(
        'update:logic',
        updateArrayElement(
          this.logic,
          index,
          l => ({
            ...l,
            conditions: updateArrayElement(l.conditions, conditionIndex, updates)
          })
        )
      )
    },
    handleChangeGoto: function (index, goto) {
      this.$emit(
        'update:logic',
        updateArrayElement(this.logic, index, { goto })
      )
    },
    handleDeleteCondition: function (index, conditionIndex) {
      let newLogicState
      if (this.logic[index].conditions.length === 1) {
        newLogicState = [...this.logic.slice(0, index), ...this.logic.slice(index + 1)]
      } else {
        newLogicState = updateArrayElement(
          this.logic,
          index,
          l => ({
            ...l,
            conditions: l.conditions.filter((c, i) => i !== conditionIndex),
            goto: undefined
          }))
      }
      this.$emit('update:logic', newLogicState)
    },
    hasConditions: function (index) {
      return this.logic[index].conditions?.length
    }
  }
}
</script>

<style scoped>

</style>
