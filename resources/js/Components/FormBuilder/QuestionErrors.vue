<template>
  <div
    v-if="errors"
    class="flex justify-end"
  >
    <Error class="w-3/4 pr-4">
      {{ errors }}
    </Error>
  </div>
</template>

<script>
import Error from '../../Components/FormBuilder/Error'

export default {
  name: 'QuestionError',
  components: { Error },
  props: { errors: { type: String, default: undefined } }
}
</script>

<style scoped>

</style>
