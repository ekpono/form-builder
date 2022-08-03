<template>
  <div>
    <div class="flex md:gap-4 flex-wrap">
      <div
        v-for="choice in choices"
        :key="choice.id"
        class="even:pl-2 odd:pr-2 w-1/2 pb-4 md:pr-0 md:w-auto"
      >
        <ChoiceButton
          :checked="checked === choice.id"
          class="w-full choice"
          @click="handleClickChoice(choice.id)"
        >
          <span>{{ choice.label }}</span>
        </ChoiceButton>
      </div>
    </div>
  </div>
</template>

<script>
import ChoiceButton from '../../Components/FormRunner/ChoiceButton'

export default {
  name: 'YesNo',
  components: {
    ChoiceButton
  },
  props: {
    properties: { type: Object, required: true },
    withConfirmation: { type: Boolean, default: false },
    initValue: { type: Object, default: () => ([]) }
  },
  emits: ['update:answer', 'update:value'],
  data: function () {
    return {
      checked: this.initValue && this.initValue[0]?.id,
      otherValue: '',
      editOther: false
    }
  },
  computed: {
    choices: function () {
      return this.properties.choices
    }
  },
  methods: {
    toggleChoice: function (choiceId) {
      this.$data.checked = this.$data.checked === choiceId
        ? null
        : choiceId
    },
    handleClickChoice: function (choiceId) {
      this.toggleChoice(choiceId)
      this.$emit(
        this.withConfirmation && choiceId === this.choices[0].id ? 'update:value' : 'update:answer',
        [{ id: this.$data.checked, value: this.choices.find(c => c.id === this.$data.checked).label }]
      )
    }
  }
}
</script>

<style scoped>
.choice {
    min-width: 100px;
    justify-content: center;
}
</style>
