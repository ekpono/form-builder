<template>
  <div>
    <div class="flex flex-wrap">
      <div
        v-for="choice in choices"
        :key="choice.id"
        class="even:pl-2 odd:pr-2 w-1/2 pb-4"
      >
        <ChoiceButton
          :checked="checked.indexOf(choice.id) !== -1"
          class="w-full"
          @click="handleClickChoice(choice.id)"
        >
          {{ choice.label }}
        </ChoiceButton>
      </div>
      <div
        v-if="properties.allow_other_choice"
        class="even:pl-2 odd:pr-2 w-1/2 pb-4"
      >
        <ChoiceButton
          v-click-outside="stopEditingOther"
          :checked="checked.indexOf('other') !== -1"
          class="w-full"
          @click="handleClickOther"
        >
          <input
            ref="other"
            type="text"
            :disabled="!editOther"
            class="w-full text-left h-6 bg-transparent focus:border-0 border-0 focus:ring-0 outline-none focus:outline-none shadow-none"
            :class="{'pointer-events-none': !editOther}"
            placeholder="Enter you answer"
            :value="otherValue || (editOther ? '' : 'other')"
            @input="handleChangeOther"
          >
        </ChoiceButton>
      </div>
    </div>
  </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'
import { shuffle } from '@/functions'
import ChoiceButton from '@/Components/FormRunner/ChoiceButton'

export default {
  name: 'MultipleChoice',
  components: {
    ChoiceButton
  },
  directives: {
    clickOutside: vClickOutside.directive
  },
  props: {
    properties: { type: Object, required: true },
    initValue: { type: Array, default: () => ([]) }
  },
  emits: ['update:answer', 'update:value'],
  data: function () {
    return {
      checked: (this.initValue || []).map(a => a.id),
      otherValue: '',
      editOther: false
    }
  },
  computed: {
    choices: function () {
      return this.properties.randomize ? shuffle(this.properties.choices) : this.properties.choices
    }
  },
  watch: {
    checked: {
      deep: true,
      handler: 'saveValue'
    },
    otherValue: {
      handler: 'saveValue'
    }
  },
  methods: {
    toggleChoice: function (choiceId) {
      this.$data.checked = this.$data.checked.indexOf(choiceId) !== -1
        ? this.$data.checked.filter(c => c !== choiceId)
        : [...this.$data.checked, choiceId]
    },
    handleClickChoice: function (choiceId) {
      this.toggleChoice(choiceId)
      if (!this.properties.allow_multiple_selection) {
        this.sendAnswer()
      }
    },
    handleClickOther: function () {
      const isChecked = this.$data.checked.indexOf('other') !== -1

      if (this.editOther && isChecked) {
        return
      }
      if (!isChecked) {
        this.editOther = true
        setTimeout(() => this.$refs.other.focus(), 100)
      }
      this.toggleChoice('other')
    },
    stopEditingOther: function () {
      this.editOther = false
      this.$refs.other.blur()
    },
    handleChangeOther: function (e) {
      this.otherValue = e.target.value
    },
    saveValue: function () {
      this.$emit('update:value', this.getAnswers())
    },
    sendAnswer: function () {
      this.$emit('update:answer', this.getAnswers())
    },
    getAnswers: function () {
      return this.$data.checked.map(id => id === 'other'
        ? { id: 'other', value: this.$data.otherValue }
        : { id: id, value: this.choices.find(c => c.id === id).label }
      )
    }
  }
}
</script>

<style scoped>
</style>
