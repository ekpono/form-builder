<template>
  <div class="py-4 flex gap-2">
    <SelectBox
      v-show="selectBoxItems.length > 1"
      v-model="selectedPeriod"
      :items="selectBoxItems"
      classes="py-1.5 border-blue-500 border capitalize text-blue-500"
    />
    <Input
      class="border-gray-500 border text-xxs px-4 py-0"
      :placeholder="`Enter number of ${selectedPeriod}`"
      disabled
    />
  </div>
</template>

<script>
import Input from '../../Components/Input'
import SelectBox from '../../Components/SelectBox'
export default {
  name: 'QuestionTimeDelay',
  components: { SelectBox, Input },
  props: {
    properties: {
      type: Object,
      default: () => ({
        period: ['days'],
        restrict_delay: false,
        max_delay: 1
      })
    }
  },
  data: function () {
    return {
      selectedPeriod: this.properties.period ? this.properties.period[0] : 'days'
    }
  },
  computed: {
    selectBoxItems: function () {
      return (this.properties.period || []).map(i => ({ value: i, title: i }))
    }
  }
}
</script>

<style scoped>

</style>
