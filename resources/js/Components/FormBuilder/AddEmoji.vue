<template>
  <div class="px-3 py-4">
    <VuemojiPicker
      :is-dark="false"
      :picker-style="{width: '100%', 'num-columns': 6, borderSize: 0}"
      @emojiClick="$emit('click:emoji', $event.unicode)"
    />
  </div>
</template>

<script>
import { VuemojiPicker } from 'vuemoji-picker'

export default {
  name: 'AddEmoji',
  components: {
    VuemojiPicker
  },
  props: {
    questions: { type: Array, default: () => [] },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => [] },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['update:questionCategory', 'update:question', 'click:addMedia', 'click:emoji', 'update:currentQuestion', 'update:logic']
}
</script>

<style scoped>

</style>
