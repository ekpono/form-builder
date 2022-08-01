<template>
  <div
    class="adding-popup z-40"
    :style="{top: y + 'px'}"
  >
    <QuestionCategoryAndType
      v-model:category="questionCategory"
      v-model:type="type"
      :form-category="formCategory"
    />
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
import { QUESTION_CATEGORY_FOLLOW_UP, QUESTION_CATEGORY_TYP } from '@/constants/Forms/questions'
import QuestionCategoryAndType from './QuestionCategoryAndType.vue'

export default {
  name: 'QuestionAddingPopup',
  components: { QuestionCategoryAndType },
  props: {
    formCategory: { type: String, required: true }
  },
  emits: ['add-question', 'add-kick-off', 'add-typ'],
  data: () => ({
    questionCategory: null,
    type: null,
    workspaceEl: null
  }),
  computed: {
    y: function () {
      return 64 - (document.getElementById('leftside')?.scrollTop || 0)
    }
  },
  watch: {
    questionCategory: function (c) {
      if (c === null) {
        return
      }
      if (c === QUESTION_CATEGORY_TYP) {
        this.$emit('add-typ', { id: uuid(), properties: {} })
        this.reset()
      }
    },
    type: function (t) {
      if (t === null) {
        return
      }
      this.$emit(
        this.questionCategory === QUESTION_CATEGORY_FOLLOW_UP ? 'add-question' : 'add-kick-off',
        { type: t, id: uuid(), properties: {} }
      )
      this.reset()
    }
  },
  methods: {
    reset: function () {
      this.questionCategory = null
      this.type = null
    }
  }
}
</script>

<style scoped>
.adding-popup {
  border: 1px solid #b7b7b7;
  background: #fff;
  position: absolute;
  /*top: 4rem;*/
  left: 16.666667%;;
  border-radius: 2px;
  min-width: 238px;
}
.adding-popup:before {
  content: '';
  position: absolute;
  left: -41px;
  top: 10px;
  border: 15px solid transparent;
  border-right: 25px solid #b7b7b7;
}
.adding-popup:after {
  content: '';
  position: absolute;
  left: -40px;
  top: 10px;
  border: 15px solid transparent;
  border-right: 25px solid #fff;
}
</style>
