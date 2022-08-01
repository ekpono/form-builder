<template>
  <div>
    <template v-if="allowChangeSettings">
      <QuestionCategoryAndType
        :category="questionCategory"
        :type="question.type"
        :form-category="formCategory"
        @update:category="$emit('update:questionCategory', $event)"
        @update:type="handleChangeQuestionType"
      />
      <div
        v-if="settings"
        class="border-b py-4 px-3"
      >
        <component
          :is="s.c"
          v-for="(s, settingName) in settings"
          v-show="s.depends ? isSettingSet(s.depends) : true"
          :key="`setting-${settingName}`"
          v-bind="s.props || {}"
          :settings="s.s"
          class="pt-1 pb-2"
          :model-value="question.properties[settingName]"
          @update:modelValue="handleChangeQuestionProp(settingName, $event)"
        >
          {{ settingTitles[settingName] }}
        </Component>
      </div>
    </template>
    <div class="px-3 pt-4 pb-12">
      <div
        class="text-xs text-navy flex justify-between select-none cursor-pointer"
      >
        <div
          class="flex-grow"
          @click="handleClickAddMedia"
        >
          {{ hasImage ? 'Change' : 'Add' }} image
        </div>
        <TrashIcon
          v-if="hasImage"
          width="20"
          height="20"
          icon-color="red"
          @click="handleDeleteAttachments"
        />
        <AddMediaIcon
          v-else
          width="20"
          height="20"
          icon-color="gray"
          @click="handleClickAddMedia"
        />
      </div>
    </div>
  </div>
</template>

<script>
import QuestionCategoryAndType from './QuestionCategoryAndType.vue'
import SettingSwitch from './SettingSwitch.vue'
import { QUESTION_CATEGORY_KICK_OFF, SETTING_TITLE, SETTINGS } from '@/constants/Forms/questions'
import AddMediaIcon from './Icons/AddMediaIcon.vue'
import { FORM_CATEGORY_PRE_REVIEW } from '@/constants/Forms/form'
import TrashIcon from '@/Components/FormBuilder/Icons/TrashIcon'

export default {
  name: 'QuestionSettings',
  components: {
    AddMediaIcon,
    QuestionCategoryAndType,
    SettingSwitch,
    TrashIcon
  },
  props: {
    question: { type: Object, default: undefined },
    questionCategory: { type: String, default: undefined },
    logic: { type: Array, default: () => [] },
    questions: { type: Array, default: () => [] },
    formCategory: { type: String, required: true },
    forms: { type: Array, default: () => [] }
  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic'],
  computed: {
    settings: function () {
      return SETTINGS[this.question.type] || null
    },
    settingTitles: () => SETTING_TITLE,
    allowChangeSettings: function () {
      return !(this.formCategory === FORM_CATEGORY_PRE_REVIEW && this.questionCategory === QUESTION_CATEGORY_KICK_OFF)
    },
    hasImage: function () {
      return this.question.attachments && this.question.attachments[0]
    }
  },
  mounted: function () {
    if (this.settings && Object.keys(this.settings).indexOf('period') && !this.question.properties.period) {
      this.handleChangeQuestionProp('period', ['days'])
    }
  },
  updated: function () {
    if (this.settings && Object.keys(this.settings).indexOf('period') && !this.question.properties.period) {
      this.handleChangeQuestionProp('period', ['days'])
    }
  },
  methods: {
    handleChangeQuestionType (type) {
      this.$emit('update:question', { ...this.question, type, properties: {} })
    },
    handleChangeQuestionProp (p, v) {
      this.$emit(
        'update:question',
        {
          ...this.question,
          properties: {
            ...this.question.properties,
            [p]: v
          }
        }
      )
    },
    isSettingSet (settingName) {
      return !!this.question.properties[settingName]
    },
    handleClickAddMedia () {
      this.$emit('click:addMedia')
    },
    handleDeleteAttachments () {
      this.$emit(
        'update:question',
        { ...this.question, attachments: [] })
    }

  }
}
</script>

<style scoped>
</style>
