<template>
  <div class="px-3 py-4">
    <SelectBox
      label="From question"
      :items="questionSelectBoxItems"
      :model-value="question.id"
      classes="h-10"
      @update:modelValue="$emit('update:currentQuestion', { id: $event })"
    />
    <div
      v-if="question.category === QUESTION_CATEGORY_TYP"
      class="text-gray-600 text-xs py-2"
    >
      You can't store answer for thank you page
    </div>
    <div
      v-if="question.properties.choices"
      class="py-2"
    >
      <div class="text-xs text-gray-500 pb-2">
        Selected which answer options you want to save
      </div>
      <div
        v-for="choice in question.properties.choices"
        :key="`${question.id}-choice=${choice.id}`"
      >
        <Label>
          <div class="flex justify-between">
            <span class="w-3/4 truncate">{{ choice.label }}</span>
            <div class="px-2">
              <Checkbox
                :checked="checkedOptions.indexOf(choice.id) !== -1"
                @update:checked="handleCheck(choice.id, $event)"
              />
            </div>
          </div>
        </Label>
      </div>
      <div v-if="question.properties.allow_other_choice">
        <Label>
          <div class="flex justify-between">
            <span>Other</span>
            <div class="px-2">
              <Checkbox @update:checked="handleCheck('other', $event)" />
            </div>
          </div>
        </Label>
      </div>
    </div>
    <div class="text-xs text-gray-500 py-2">
      {{ showParamsSelect ? 'Select' : 'Selected' }}  CRM parameter which for saved answer
    </div>
    <button
      v-if="!showParamsSelect"
      class="border rounded px-2 py-1 w-full text-left relative pr-6"
      @click="toggleShowParamsSelect"
    >
      <strong>{{ crmParamsGroupTitle[question.storeAnswer.param_group] }}</strong> - {{ question.storeAnswer.param }}
      <div class="absolute right-1 top-1 bottom-1 flex items-center">
        <StopIcon
          class="h-8 cursor-pointer"
          @click="remove"
        />
      </div>
    </button>
    <template v-else>
      <Accordion
        v-for="(params, crmParamGroup) in crmParams"
        :key="`store-answer-crm-param-group-${crmParamGroup}`"
        :title="crmParamsGroupTitle[crmParamGroup]"
        class="p-2 border-b last:border-b-0 text-xs"
      >
        <div
          class="border-t mt-2 py-1"
        >
          <button
            v-for="param in params"
            :key="`store-answer-crm-param-${param}`"
            class="block w-full text-left py-1 my-1 rounded px-4 text-sm text-navy hover:bg-blue-900 hover:text-white transition-all duration-300"
            @click="handleUpdate({ param_group: crmParamGroup, param }); toggleShowParamsSelect()"
          >
            {{ param }}
          </button>
        </div>
      </Accordion>
      <button
        v-if="typeof ownCrmParam !== 'string'"
        class="text-xxs flex gap-2 mt-2"
        @click="addOwnParam"
      >
        <PlusIcon class="h-3 text-gray-600" /> Add new parameter
      </button>
      <div
        v-if="typeof ownCrmParam === 'string'"
        class="py-2 relative"
      >
        <Input
          v-model="ownCrmParam"
          placeholder="Enter the param name"
          class="w-full text-sm p-1 pr-6"
        />
        <StopIcon
          class="h-8 absolute right-1 top-2 cursor-pointer"
          @click="ownCrmParam = null"
        />
      </div>
    </template>
    <template v-if="checkedOptions.length > 0">
      <div
        class="text-xs text-gray-500 py-2"
      >
        How should answer options should be saved in CRM?
      </div>
      <div>
        <div class="text-xxs text-gray-500 flex">
          <div>
            Selected answers
          </div>
          <div>
            Format
          </div>
          <div>
            Data
          </div>
        </div>
        <div class="pb-12">
          <div
            v-for="choice in question.storeAnswer.choices"
            :key="`store-answer-store-as-${choice.id}`"
            class="flex border-b last:border-b-0 py-3"
          >
            <div class="w-1/3 truncate text-sm py-1">
              {{ choicesMappedById[choice.id].label }}
            </div>
            <div class="w-1/3">
              <SelectBox
                label=""
                :items="dataFormatSelectBoxOptions"
                :model-value="choice.format || dataFormatSelectBoxOptions[0].value"
                @update:modelValue="handleUpdateChoice(choice.id, { format: $event})"
              />
            </div>
            <div class="w-1/3 pl-1">
              <Input
                :type="dataFormat.find(o => o.value === choice.format)?.inputType || 'text'"
                class="w-full text-sm p-1"
                :model-value="choice.value || choicesMappedById[choice.id].label"
                @update:modelValue="handleUpdateChoice(choice.id, { value: $event })"
              />
            </div>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import { QUESTION_CATEGORY_KICK_OFF, QUESTION_CATEGORY_TYP } from '@/constants/Forms/questions'
import SelectBox from '@/Components/SelectBox'
import Checkbox from '@/Components/Checkbox'
import Label from '@/Components/Label'
import Accordion from '@/Components/Accordion'
import Input from '@/Components/Input'
import { PlusIcon } from '@heroicons/vue/solid'
import StopIcon from '@/Components/FormBuilder/Icons/StopIcon'

export default {
  name: 'StoreAnswer',
  components: {
    Input,
    Checkbox,
    SelectBox,
    Label,
    Accordion,
    PlusIcon,
    StopIcon
  },
  props: {
    questions: { type: Array, default: () => ([]) },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => ([]) },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic', 'update:storeAnswer'],
  data: function () {
    return {
      QUESTION_CATEGORY_TYP,
      ownCrmParam: this.question.storeAnswer?.param_group === 'ownCrmParams' && this.question.storeAnswer.param,
      crmParamsGroupTitle: {
        contact: 'Contact Information',
        personal: 'Personal Information',
        timeDelay: 'Time Delay',
        ownCrmParams: 'Other'
      },
      dataFormat: [
        { value: 'text', inputType: 'text' },
        { value: 'days', inputType: 'number' },
        { value: 'weeks', inputType: 'number' }
      ],
      showParamsSelect: !this.question?.storeAnswer?.param
    }
  },
  computed: {
    crmParams: function () {
      return {
        contact: ['email', 'phone'],
        personal: ['first_name', 'last_name'],
        timeDelay: ['pre_review_message', 'pre_review_follow_up_message', 'purchase_review']
      }
    },
    questionSelectBoxItems: function () {
      return this.questions.filter(q => q.category !== QUESTION_CATEGORY_TYP).map(q => ({
        value: q.id,
        title: `${q.category === QUESTION_CATEGORY_KICK_OFF ? 'KO' : 'FO'}Q${q.index} - ` + (q.title || 'No title')
      }))
    },
    choicesMappedById: function () {
      if (!this.question.properties?.choices || this.question.properties.choices.length === 0) {
        return {}
      }
      return {
        ...Object.fromEntries(this.question.properties.choices.map(choice => [choice.id, choice])),
        ...(this.question.properties.allow_other_choice ? { other: { label: 'other' } } : {})
      }
    },
    dataFormatSelectBoxOptions: function () {
      return this.dataFormat.map(d => ({ value: d.value, title: d.value }))
    },
    checkedOptions: function () {
      return (this.question.storeAnswer?.choices || []).map(c => c.id)
    }
  },
  watch: {
    ownCrmParam: function () {
      console.log(this.ownCrmParam)
      if (this.ownCrmParam) {
        this.handleUpdate({ param_group: 'ownCrmParams', param: this.ownCrmParam })
      } else if (this.question.storeAnswer?.param_group === 'ownCrmParams') {
        this.remove()
      }
    }
  },
  methods: {
    handleCheck: function (id, checked) {
      this.handleUpdate({
        choices: checked
          ? [...(this.question.storeAnswer?.choices || []), { id }]
          : this.question.storeAnswer.choices.filter(c => c.id !== id)
      })
    },
    handleUpdate: function (updates) {
      this.$emit(
        'update:question',
        {
          ...this.question,
          storeAnswer: { ...(this.question.storeAnswer || {}), ...updates }
        }
      )
    },
    remove: function () {
      this.$emit(
        'update:question',
        { ...this.question, storeAnswer: {} }
      )
    },
    handleUpdateChoice: function (choiceId, updates) {
      this.handleUpdate({
        choices: this.question.storeAnswer.choices.map(c => c.id === choiceId ? { ...c, ...updates } : c)
      })
    },
    toggleShowParamsSelect: function () {
      this.showParamsSelect = !this.showParamsSelect
    },
    addOwnParam: function () {
      this.ownCrmParam = ''
    }
  }
}
</script>

<style scoped>

</style>
