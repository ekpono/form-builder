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
      You can't add logic jump for thank you page
    </div>
  </div>
  <template v-if="question.category !== QUESTION_CATEGORY_TYP">
    <div
      v-for="(l, i) in questionLogics"
      :key="`logic${i}`"
      class="border-b last:border-0"
    >
      <div class="px-3 py-4">
        <SelectBox
          label="From question"
          :items="questionSelectBoxItems"
          :model-value="l.question_id"
          classes="h-10"
          @update:modelValue="$emit('update:currentQuestion', { id: $event })"
        />
        <div
          v-if="!hasConditions(l.index)"
          class="py-4"
        >
          <div class="text-xs text-gray-500">
            ALWAYS jump to
          </div>
          <div class="relative">
            <SelectBox
              :items="questionSelectBoxItems.filter(q => q.value !== l.question_id && !q.isKickOff)"
              placeholder="Select question"
              classes="h-10"
              :model-value="l.otherwise"
              @update:modelValue="handleAddOtherwise(l.index, $event)"
            />
            <div
              v-if="l.otherwise"
              class="absolute inset-y-0 right-7 flex items-center cursor-pointer"
              @click="handleRemoveOtherwise(l.index)"
            >
              <StopIcon height="16" />
            </div>
          </div>
        </div>
        <template v-if="!hasConditions(l.index)">
          <div class="text-xs font-bold text-gray-500">
            OR
          </div>
          <div class="py-2">
            <button
              type="button"
              class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 gap-1 font-bold"
              @click="handleAddCondition(l.index)"
            >
              <JumpIcon
                icon-color="#fff"
                height="11"
                width="20"
              />
              <span>Add logic</span>
            </button>
          </div>
        </template>
        <LogicJumpCondition
          v-for="(condition, i) in l.conditions"
          :key="`logic-jump-condition-${i}`"
          :first="i === 0"
          :logic-op="condition.logic_op"
          :op="condition.op"
          :compare-with="condition.compare_with"
          :question-number="questionNumber"
          :question="question"
          :condition-index="i"
          :logic-index="l.index"
          @update:op="handleUpdateCondition(l.index, i, { op: $event })"
          @update:compareWith="handleUpdateCondition(l.index, i, { compare_with: $event })"
          @update:logicOp="handleUpdateCondition(l.index, i, { logic_op: $event })"
          @delete="handleDeleteCondition(l.index, i)"
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
            Then Jump respondent to question
          </div>
          <div>
            <SelectBox
              style="width: 155px;"
              :items="questionSelectBoxItems.filter(q => q.value !== l.question_id && !q.isKickOff)"
              placeholder="Select question"
              :model-value="l.goto"
              :font-size="10"
              classes="h-9"
              @update:modelValue="handleChangeGoto(l.index, $event)"
            />
          </div>
        </div>
      </div>
      <div
        v-if="hasConditions(l.index)"
        class="pt-5 pb-6 px-3"
      >
        <div class="text-xs text-gray-500">
          In all other instances, ALWAYS jump to:
        </div>
        <div class="relative">
          <SelectBox
            :items="questionSelectBoxItems.filter(q => q.value !== l.question_id && !q.isKickOff)"
            placeholder="Select question"
            :model-value="l.otherwise"
            @update:modelValue="handleAddOtherwise(l.index, $event)"
          />
          <div
            v-if="l.otherwise"
            class="absolute inset-y-0 right-7 flex items-center cursor-pointer"
            @click="handleRemoveOtherwise"
          >
            <StopIcon height="16" />
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="showAddLogicButton"
      class="py-4 px-3 text-right"
    >
      <button
        type="button"
        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 gap-1 font-bold"
        @click="addLogicJump"
      >
        Add another logic jump?
      </button>
    </div>
  </template>
</template>

<script>
import SelectBox from '@/Components/SelectBox'
import JumpIcon from '@/Components/FormBuilder/Icons/JumpIcon'
import StopIcon from '@/Components/FormBuilder/Icons/StopIcon'
import { QUESTION_CATEGORY_KICK_OFF, QUESTION_CATEGORY_TYP } from '@/constants/Forms/questions'
import { updateArrayElement } from '@/functions'
import LogicJumpCondition from '@/Components/FormBuilder/LogicJumpCondition'
import { TYPE_LOGIC_JUMP } from '@/constants/Forms/logicJump'

export default {
  name: 'LogicJump',
  components: { LogicJumpCondition, SelectBox, JumpIcon, StopIcon },
  props: {
    questions: { type: Array, default: () => ([]) },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => ([]) },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic'],
  data: () => ({
    QUESTION_CATEGORY_TYP
  }),
  computed: {
    questionSelectBoxItems: function () {
      return this.questions.map(q => ({
        value: q.id,
        title: `${q.category === QUESTION_CATEGORY_TYP ? 'TYP' : 'Q'}${q.index} - ` + (q.title || 'No title'),
        isKickOff: q.category === QUESTION_CATEGORY_KICK_OFF,
        isTYP: q.category === QUESTION_CATEGORY_TYP
      }))
    },
    questionLogics: function () {
      return this.logic.map((l, index) => ({ ...l, index })).filter(l => l.question_id === this.question.id && l.type === TYPE_LOGIC_JUMP)
    },
    questionNumber: function () {
      return this.questions.findIndex(q => q.id === this.question.id) + 1
    },
    showAddLogicButton: function () {
      return !!this.questionLogics[this.questionLogics.length - 1]?.goto
    }
  },
  mounted: function () {
    if (this.questionLogics.length === 0) {
      this.addLogicJump()
    }
  },
  updated: function () {
    if (this.questionLogics.length === 0) {
      this.addLogicJump()
    }
  },
  unmounted () {
    this.questionLogics.forEach(l => {
      if (l.conditions?.length === 0 && !l.otherwise) {
        this.$emit(
          'update:logic',
          this.logic.filter((_, i) => i !== l.index)
        )
      }
    })
  },
  methods: {
    hasConditions: function (index) {
      return this.logic[index].conditions?.length
    },
    handleAddOtherwise: function (id, event) {
      this.questionLogics.forEach(l => {
        this.$emit(
          'update:logic',
          updateArrayElement(this.logic, l.index, { otherwise: event })
        )
      })
    },
    handleRemoveOtherwise: function () {
      this.questionLogics.forEach(l => {
        this.$emit(
          'update:logic',
          updateArrayElement(this.logic, l.index, { otherwise: undefined })
        )
      })
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
      console.log(index, goto)
      this.$emit(
        'update:logic',
        updateArrayElement(this.logic, index, { goto })
      )
    },
    handleDeleteCondition: function (index, conditionIndex) {
      this.$emit(
        'update:logic',
        updateArrayElement(
          this.logic,
          index,
          l => ({
            ...l,
            conditions: l.conditions.filter((c, i) => i !== conditionIndex),
            goto: undefined
          }))
      )
    },
    addLogicJump: function () {
      this.$emit('update:logic', [...this.logic, { question_id: this.question.id, type: TYPE_LOGIC_JUMP }])
    }
  }
}
</script>

<style scoped>
</style>
