<template>
  <div class="flex py-4 px-2 gap-4">
    <div class="w-1/4 font-bold flex items-start justify-between pt-1">
      <div>
        <ControlsIcon
          class="cursor-pointer text-gray-600 hover:text-black"
          width="22"
          height="22"
          icon-color="currentColor"
          @click="$emit('click:settings')"
        />
      </div>
      <div class="flex gap-2">
        <span
          class="text-lg"
          :style="{ color: theme?.questions }"
        >{{ iconLetter }}{{ index }}</span>
        <span
          class="inline-block w-5 h-5 bg-black rounded-full text-white flex items-center justify-center mt-1"
          :style="{ backgroundColor: theme?.questions }"
        >
          <ArrowRightIcon class="h-4 w-4" />
        </span>
      </div>
    </div>
    <div class="w-3/4 pr-4">
      <TextField
        :key="`title${question.id}`"
        ref="title"
        class="text-2xl"
        :style="{ color: theme?.questions }"
        placeholder="Add title"
        :model-value="question.title"
        :required="question.properties.required"
        @update:modelValue="$emit('update:question', { ...question, title: $event })"
        @spyCaret="spyCaret('title', $event)"
      />
      <TextField
        :key="`description${question.id}`"
        ref="description"
        class="text-xl text-gray-600"
        :style="{ color: theme?.descriptions }"
        placeholder="Description (optional)"
        :model-value="question.description"
        @update:modelValue="$emit('update:question', { ...question, description: $event })"
        @spyCaret="spyCaret('description', $event)"
      />
      <div
        v-if="question.attachments && question.attachments.length > 0"
        class="flex gap-2 py-4"
      >
        <div
          v-for="file in question.attachments"
          :key="`question-view-file-${file.src}`"
          class="max-w-xs"
        >
          <img
            class="w-full"
            :src="`/storage/${file.src}`"
            alt=""
          >
        </div>
      </div>
      <div
        v-if="questionComponent"
        class="py-3 lg:w-8/12"
      >
        <component
          :is="questionComponent"
          :key="question.id"
          ref="QuestionComponent"
          :properties="question.properties"
          @update:properties="$emit('update:question', { ...question, properties: $event })"
          @spyCaret="setCaret"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { ArrowSmRightIcon } from '@heroicons/vue/outline'
import {
  QUESTION_CATEGORY_TYP, QUESTION_TYPE_DELAY,
  QUESTION_TYPE_MULTIPLE_CHOICE,
  QUESTION_TYPE_OPEN, QUESTION_TYPE_RATING_SCORE,
  QUESTION_TYPE_YES_NO
} from '@/constants/Forms/questions'
import QuestionOpen from './QuestionOpen.vue'
import QuestionMultipleChoice from './QuestionMultipleChoice.vue'
import QuestionYesNo from './QuestionYesNo.vue'
import QuestionTimeDelay from '@/Components/FormBuilder/QuestionTimeDelay'
import QuestionRatingScore from '@/Components/FormBuilder/QuestionRatingScore'
import TextField from '@/Components/FormBuilder/TextField'
import ControlsIcon from '@/Components/FormBuilder/Icons/ControlsIcon'

export default {
  name: 'QuestionView',
  components: {
    ArrowRightIcon: ArrowSmRightIcon,
    QuestionOpen,
    TextField,
    ControlsIcon
  },
  props: {
    question: {
      type: Object,
      props: {
        title: { type: String, default: '' },
        type: { type: String },
        properties: { type: Object, default: {} }
      },
      required: true
    },
    index: { type: Number, required: true },
    questionType: { type: String, required: true },
    theme: { type: Object, default: undefined }
  },
  emits: ['update:question', 'spyCaret', 'click:settings'],
  data: function () {
    return {
      caret: { property: null, pos: 0 }
    }
  },
  computed: {
    iconLetter: function () {
      return this.questionType === QUESTION_CATEGORY_TYP ? 'TYP' : 'Q'
    },
    questionComponent: function () {
      return {
        [QUESTION_TYPE_OPEN]: QuestionOpen,
        [QUESTION_TYPE_MULTIPLE_CHOICE]: QuestionMultipleChoice,
        [QUESTION_TYPE_YES_NO]: QuestionYesNo,
        [QUESTION_TYPE_DELAY]: QuestionTimeDelay,
        [QUESTION_TYPE_RATING_SCORE]: QuestionRatingScore
      }[this.question.type] || null
    }
  },
  watch: {
    question: function (v, p) {
      if (v?.id !== p?.id) {
        this.description = this.question?.description
        this.title = this.question?.title
        this.caret = { property: null, pos: 0 }
      }
    }
  },
  methods: {
    setCaret: function (property, pos, selection) {
      this.caret = { property, pos, selection }
    },
    spyCaret: function (property, { pos, selection }) {
      this.caret = {
        property,
        pos,
        selection
      }
    },
    addEmojiAndFocus: function (e) {
      if (!this.caret.property) {
        return
      }
      const el = this.$refs[this.caret.property]
      if (!el) {
        this.$refs.QuestionComponent.addEmojiAndFocus && this.$refs.QuestionComponent.addEmojiAndFocus(e, this.caret.property, this.caret.pos)
        return
      }
      el.inject(e, this.caret.pos, this.caret.selection)
    },
    inject: function (value) {
      if (!this.caret.property) {
        return
      }
      const el = this.$refs[this.caret.property]
      if (!el || !el.inject) {
        return
      }
      el.inject(value, this.caret.pos, this.caret.selection)
    }
  }
}
</script>

<style scoped>
</style>
