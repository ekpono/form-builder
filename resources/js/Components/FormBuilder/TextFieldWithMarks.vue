<template>
  <template
    v-for="chunk in renderArray"
    :key="chunk"
  >
    <template v-if="!chunk.c">
      {{ chunk }}
    </template>
    <component
      :is="chunk.c"
      v-if="chunk.c"
      @clickDelete="$emit('removeMark', chunk.index)"
    >
      {{ chunk.d }}
    </component>
  </template>
</template>

<script>
import TextFieldMark from './TextFieldMark'

export default {
  name: 'TextFieldWithMarks',
  components: { TextFieldMark },
  props: {
    text: { type: String, default: '' },
    marks: { type: Array, default: () => [] }
  },
  emits: ['removeMark'],
  computed: {
    renderArray: function () {
      const textArray = this.text.split('')
      const newTextArray = []
      let cursor = 0
      for (const index in this.marks) {
        const [start, end] = this.marks[index]
        newTextArray.push(textArray.slice(cursor, start).join(''))
        newTextArray.push({ c: TextFieldMark, d: textArray.slice(start, end).join(''), index })
        cursor = end
      }
      newTextArray.push(textArray.slice(cursor).join(''))
      return newTextArray
    }
  }
}
</script>

<style scoped>

</style>
