<template>
  <div class="py-2">
    <div
      v-if="!first"
      class="pb-2 flex gap-3 items-center"
    >
      <div>
        <RadioButton
          :name="`${name}-logic-op-${questionNumber}-${logicIndex}-${conditionIndex}`"
          label="AND"
          :model-value="logicOp === 'AND'"
          @update:modelValue="$emit('update:logicOp', 'AND')"
        />
        <RadioButton
          :name="`${name}-logic-op-${questionNumber}-${logicIndex}-${conditionIndex}`"
          label="OR"
          :model-value="logicOp === 'OR'"
          @update:modelValue="$emit('update:logicOp', 'OR')"
        />
      </div>
      <div>
        <TrashIcon
          width="12"
          class="cursor-pointer"
          @click="$emit('delete')"
        />
      </div>
    </div>
    <div class="text-xs text-gray-500 py-1">
      {{ first
        ? `If answer to question [Q${questionNumber}] is`
        :'Answer option' }}:
    </div>
    <div class="flex pt-1 gap-2">
      <div>
        <template v-if="editOp || !op">
          <RadioButton
            v-for="(compareOption, i) in compareOptions"
            :key="`compareOption-${questionNumber}-${logicIndex}-${i}`"
            :name="`compareOption-${questionNumber}-${logicIndex}-${logicIndex}-${conditionIndex}`"
            :label="compareOption.title"
            :model-value="compareOption.value === op"
            @update:modelValue="handleSetCompareOperator(compareOption.value)"
          />
        </template>
        <template v-if="!editOp && op">
          <RadioButton
            :name="`compareOption-${questionNumber}-${logicIndex}-${logicIndex}-${conditionIndex}`"
            :label="compareOptions.find(o => o.value === op)?.title"
            :model-value="true"
          />
        </template>
      </div>
      <div
        v-if="op"
        class="flex gap-2"
      >
        <EditIcon
          width="12"
          class="cursor-pointer"
          @click="editOp = !editOp"
        />
        <TrashIcon
          v-if="first"
          width="12"
          class="cursor-pointer"
          @click="$emit('delete')"
        />
      </div>
    </div>
    <div class="flex pt-2 gap-2 items-center justify-between">
      <div class="text-xxs text-gray-500">
        {{ answerOptionsForSelectBox ? 'Answer option' : 'Value' }}:
      </div>
      <div class="inline-input">
        <Input
          v-if="!answerOptionsForSelectBox"
          :model-value="compareWith.val"
          class="border p-1"
          @update:modelValue="handleUpdateCompareWith({ val: $event })"
        />
        <SelectBox
          v-if="answerOptionsForSelectBox"
          :model-value="compareWith.id"
          placeholder="Select answer option"
          :items="answerOptionsForSelectBox"
          classes="h-9"
          :font-size="10"
          @update:modelValue="handleUpdateCompareWith({ id: $event })"
        />
      </div>
    </div>
  </div>
</template>

<script>
import RadioButton from '../../Components/RadioButton'
import EditIcon from '../../Components/FormBuilder/Icons/EditIcon'
import TrashIcon from '../../Components/FormBuilder/Icons/TrashIcon'
import SelectBox from '../../Components/SelectBox'
import Input from '../../Components/Input'
import { QUESTION_TYPE_MULTIPLE_CHOICE, QUESTION_TYPE_YES_NO } from '../../constants/Forms/questions'

export default {
  name: 'LogicJumpCondition',
  components: { Input, SelectBox, RadioButton, EditIcon, TrashIcon },
  props: {
    first: { type: Boolean, default: false },
    question: { type: Object, default: () => ({}) },
    questionNumber: { type: Number, default: 1 },
    logicOp: { type: String, default: undefined },
    op: { type: String, default: undefined },
    compareWith: { type: Object, default: () => ({}) },
    conditionIndex: { type: Number, default: 0 },
    logicIndex: { type: Number, default: 0 }
  },
  emits: ['update:op', 'update:logicOp', 'update:compareWith', 'delete'],
  data: function () {
    return {
      editOp: false
    }
  },
  computed: {
    compareOptions: function () {
      return [
        { title: 'equal to', value: '==' },
        { title: 'NOT equal to', value: '!=' },
        ...([QUESTION_TYPE_MULTIPLE_CHOICE, QUESTION_TYPE_YES_NO].indexOf(this.question.type) === -1
          ? [
              { title: 'lower than', value: '<' },
              { title: 'greater than', value: '>' },
              { title: 'lower or equal to', value: '<=' },
              { title: 'greater or equal to', value: '>=' }
            ]
          : [])
      ]
    },
    answerOptionsForSelectBox: function () {
      return this.question.properties?.choices?.map(c => ({ value: c.id, title: c.label }))
    }
  },
  methods: {
    handleSetCompareOperator: function (op) {
      this.$emit('update:op', op)
      this.editOp = false
    },
    handleUpdateCompareWith: function (compareWith) {
      this.$emit('update:compareWith', compareWith)
    }
  }
}
</script>

<style scoped>
.inline-input {
    width: 155px;
    font-size: 10px;
}
</style>
