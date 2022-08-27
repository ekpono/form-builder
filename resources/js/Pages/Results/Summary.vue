<template>
  <Head :title="`Forms - Summary ${form.name}`" />
  <template>
    <Header
        :form="form"
        title="results summary"
    >
      <GoogleSheetsConnection
          :form-id="form.id"
          :has-google-identity="hasGoogleIdentity"
          :store-id="form.store_id"
          :has-google-sheet-connection="!!form.google_sheet_id"
      />
    </Header>
  </template>
  <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
    <div class="relative py-6 px-4 lg:px-8 rounded shadow bg-white h-full overflow-y-auto">
      <Summary
          :form="form"
          :summary="answersSummary"
      />
    </div>
  </div>
</template>

<script>
import Header from './../../Components/Results/Header'
import Summary from './../../Components/Results/Summary'
import GoogleSheetsConnection from './../../Components/Results/GoogleSheetsConnection'
import { Head, usePage } from '@inertiajs/inertia-vue3'

export default {
  components: {
    GoogleSheetsConnection,
    Summary,
    Header,
    Head
  },
  data: function () {
    return {
      form: usePage().props.value.form,
      answersSummary: usePage().props.value.answersSummary,
      hasGoogleIdentity: usePage().props.value.hasGoogleIdentity
    }
  }
}
</script>

<style scoped>

</style>
