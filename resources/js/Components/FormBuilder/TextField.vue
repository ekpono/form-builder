<template>
  <div class="relative">
    <div
      ref="textField"
      :class="{required: required}"
      contenteditable="true"
      :placeholder="placeholder"
      @input="handleChange($event.target.innerText)"
      @keyup="spyCaret"
      @mouseup="spyCaret"
    >
      {{ value }}
    </div>
    <div
      v-if="marks.length > 0"
      class="absolute left-0 top-0 bottom-0 right-0 pointer-events-none whitespace-pre-wrap"
    >
      <TextFieldWithMarks
        :text="modelValue"
        :marks="marks"
        @removeMark="handleRemoveMark"
      />
    </div>
  </div>
</template>

<script>
import { Cursor } from '../../cursor'
import { injectIntoString } from '../../functions'
import TextFieldWithMarks from '../../Components/FormBuilder/TextFieldWithMarks'

export default {
  name: 'TextField',
  components: {
    TextFieldWithMarks
  },
  props: {
    placeholder: { type: String, default: '' },
    modelValue: { type: String, default: '' },
    required: { type: Boolean, default: false }
  },
  emits: ['update:modelValue', 'spyCaret'],
  data: function () {
    return {
      value: this.modelValue
    }
  },
  computed: {
    marks: function () {
      const currentText = this.modelValue
      const re = /\[Recall info = answer to [K|F]OQ-(\d+)\]|{{.+?}}/g
      let match
      const marks = []
      while ((match = re.exec(currentText)) != null) {
        marks.push([match.index, match.index + match[0].length])
      }
      return marks
    }
  },
  methods: {
    handleChange: function (text) {
      this.$emit('update:modelValue', text)
    },
    spyCaret: function (event) {
      this.$emit(
        'spyCaret',
        {
          pos: Cursor.getCurrentCursorPosition(event.target),
          selection: Cursor.getCurrentSelection(event.target)
        }
      )
    },
    focus: function (pos, selection) {
      this.$refs.textField.focus()
      setTimeout(() => {
        this.setCaretPos(pos)
      }, 100)
    },
    setCaretPos: function (pos) {
      Cursor.setCurrentCursorPosition(pos, this.$refs.textField)
      this.spyCaret({ target: this.$refs.textField })
    },
    inject: function (subject, pos, selection) {
      this.value = injectIntoString(
        this.$refs.textField.innerText.replace(/(\r\n|\r|\n){2,}/g, '\n'),
        pos,
        subject
      )
      this.handleChange(this.value)
      this.focus(pos + subject.length, selection)
    },
    handleRemoveMark: function (markIndex) {
      const [start, end] = this.marks[markIndex]
      const currentText = this.$refs.textField.innerText
      const newText = currentText.substring(0, start) + currentText.substring(end)
      this.$refs.textField.innerText = newText
      this.setCaretPos(start)
      this.handleChange(newText)
    }
  }

}
</script>

<style scoped>
    .required:after {
        content: '*';
    }
</style>
