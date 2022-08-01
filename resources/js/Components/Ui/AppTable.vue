<template>
  <div class="flex flex-col my-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th v-for="(item, index) in header" :key="index" scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" :class="headerTextAligment">
                  {{ item }}
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <slot name="body"></slot>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AppTable',
  props: {
    header: {
      type: Array,
      required: true
    },
    headerTextAligment: {
      type: String,
      default: 'text-left'
    }
  }
}
</script>

<style>

</style>
