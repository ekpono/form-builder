<template>
  <div class="px-3 py-4">
    <div class="text-xs text-gray-600 pb-2">
      Which CRM data point do you want to into from using Merge Tag?
    </div>
    <div class="rounded border">
      <Accordion
        v-for="(fields, title) in tags"
        :key="`merge-tags-${title}`"
        class="p-2 border-b last:border-b-0"
        :title="title"
      >
        <div class="border-t mt-2 py-1">
          <button
            v-for="f in fields"
            :key="`merge-tags-${f}`"
            class="block w-full text-left py-1 my-1 rounded px-4 text-sm text-navy hover:bg-blue-900 hover:text-white transition-all duration-300"
            @click="$emit('update:addMark', ` {{ ${f} }} `)"
          >
            {{ f }}
          </button>
        </div>
      </Accordion>
    </div>
  </div>
</template>

<script>
import Accordion from '../../Components/Accordion'

export default {
  name: 'MergeTags',
  components: {
    Accordion
  },
  props: {
    questions: { type: Array, default: () => ([]) },
    question: { type: Object, default: null },
    logic: { type: Array, default: () => ([]) },
    forms: { type: Array, default: () => [] },
    questionCategory: { type: String, default: '' },
    formCategory: { type: String, default: '' }
  },
  emits: ['click:addMedia', 'click:emoji', 'update:addMark'],
  // TODO Probably we need to initialize this in Orders Model in PHP. Check it when form runner will start implementing
  data: function () {
    return {
      tags: Object.freeze({
        Contact: ["customer.email", "customer.phone"],
        Personal: ["customer.first_name", "customer.last_name", "customer.full_name"],
        Purchase: ["order.total_price", "order.number", "order.line_items_count", "products.name"]
      })
    }
  }
}
</script>

<style scoped>

</style>
