<template>
  <div class="flex h-full relative">
    <Form
      :form="formData"
      :form-progress="formProgress"
      :order="order"
      :is-mobile="mobilePreview"
      :is-preview="true"
      :theme="form.theme"
    />
  </div>
</template>

<script>
import Form from '../../../Components/FormRunner/Form'

export default {
  name: 'PreviewForm',
  components: {
    Form
  },
  props: {
    form: { type: Object, required: true },
    mobilePreview: { type: Boolean, default: false },
    formName: { type: String, required: true },
    formCategory: { type: String, required: true }
  },
  data: function () {
    return {
      formData: {
        name: this.formName,
        data: this.form,
        category: this.formCategory
      },
      formProgress: [],
      order: {
        data: {
          customer: { first_name: 'New', last_name: 'Customer' },
          line_items: [{
            external_product_id: 666,
            name: 'Product'
          }]
        },
        store: { domain: 'ramaroo.com' }
      }
    }
  }
}
</script>

<style scoped>

</style>
