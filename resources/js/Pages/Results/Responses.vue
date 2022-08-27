<template>
  <Head :title="`Forms - Results ${form.name}`" />
  <template>
    <Header
        :form="form"
        title="results"
    />
  </template>
  <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
    <div class="relative rounded shadow bg-white h-full overflow-y-auto">
      <PerRespondent
          :answers="answers"
          :questions="questions"
      />
    </div>
  </div>
</template>

<script>
import Header from './../../Components/Results/Header'
import PerRespondent from './../../Components/Results/PerRespondent'
import { Head, usePage } from '@inertiajs/inertia-vue3'

export default {
  components: {
    PerRespondent,
    Head,
    Header
  },
  data: function () {
    return {
      form: usePage().props.value.form,
      answers: usePage().props.value.answers
    }
  },
  computed: {
    questions: function () {
      return [...this.form.data.kick_offs, ...this.form.data.follow_ups]
    }
  }
}
</script>

<style scoped>

</style>
