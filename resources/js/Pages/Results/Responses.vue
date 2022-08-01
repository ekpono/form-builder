<template>
  <Head :title="`Forms - Results ${form.name}`" />
  <BreezeAuthenticatedLayout :fit-to-screen-height="true">
    <template #header>
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
  </BreezeAuthenticatedLayout>
</template>

<script>
import Header from './../../Components/Results/Header'
import PerRespondent from './../../Components/Results/PerRespondent'
import BreezeAuthenticatedLayout from './../../Layouts/Authenticated.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3'

export default {
  components: {
    PerRespondent,
    Head,
    BreezeAuthenticatedLayout,
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
