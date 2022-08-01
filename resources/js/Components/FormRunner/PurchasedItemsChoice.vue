<template>
  <MultipleChoice
    :properties="{choices: items, allow_multiple_selection: true}"
    :init-value="initValue"
  />
</template>

<script>
import MultipleChoice from '@/Components/FormRunner/MultipleChoice'
export default {
  name: 'PurchasedItemsChoice',
  components: { MultipleChoice },
  props: {
    withConfirmation: { type: Boolean, default: false },
    orderItems: { type: Array, required: true },
    initValue: { type: Array, default: () => ([]) },
    properties: { type: Object, default: () => ({}) }
  },
  computed: {
    items: function () {
      return this.orderItems.map(i => ({ ...i, id: i.external_product_id, label: i.name }))
    }
  }
}
</script>

<style scoped>

</style>
