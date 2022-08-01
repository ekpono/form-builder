<template>
  <div>
    <div class="flex gap-2 items-center">
      <div>
        <input
          v-model="delay"
          type="number"
          min="0"
          class="time-delay-input focus:outline-none focus:ring-0 px-0"
          placeholder="7"
          :style="{width: ((('' + delay).length || 1) * 18) + 'px'}"
          @input="handleChangeDelay"
        >
      </div>
      <div
        v-click-outside="hidePeriodSelection"
        class="time-delay-period relative"
        :class="properties.period.length > 1 ? ['cursor-pointer'] : []"
      >
        <div
          class="flex items-center gap-1 "
          @click="handleClickPeriodSelector"
        >
          <div>{{ period }}</div>
          <ChevronDownIcon
            v-if="properties.period.length > 1"
            class="h-6"
          />
        </div>
        <div
          v-show="periodSelection"
          class="absolute left-0 top-full bg-white right-0"
        >
          <div
            v-for="p in periodsForSelector"
            :key="`time-delay-period-selector=${p}`"
            class="hover:text-gray-700"
            @click="handleChangePeriod(p)"
          >
            {{ p }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'
import { ChevronDownIcon } from '@heroicons/vue/solid'

export default {
  name: 'TimeDelay',
  components: { ChevronDownIcon },
  directives: {
    clickOutside: vClickOutside.directive
  },
  props: {
    properties: { type: Object, required: true },
    initValue: { type: Array, default: () => ([]) }
  },
  emits: ['update:answer', 'update:error', 'update:value'],
  data: function () {
    return {
      delay: (this.initValue[0]?.value) || '',
      period: (this.initValue[1]?.value) || this.properties.period[0],
      periodSelection: false,
      error: false
    }
  },
  computed: {
    periodsForSelector: function () {
      return this.properties.period.filter(p => p !== this.period)
    }
  },
  methods: {
    handleChangeDelay: function (e) {
      const newDelay = parseInt(e.target.value.replace(/[^0-9.]/g, ''))
      if (this.properties.restrict_delay) {
        let newDelayInDays = newDelay
        if (this.period !== 'days') {
          newDelayInDays = this.period === 'weeks' ? newDelay * 7 : newDelay * 30
        }
        this.$emit('update:error', newDelayInDays > this.properties.max_delay ? 'Maximum delay value can be ' + this.properties.max_delay + ' days' : null)
      }
      this.$emit('update:value', [{ value: newDelay }, { value: this.period }])
      this.delay = newDelay
    },
    handleClickPeriodSelector () {
      this.periodSelection = !this.periodSelection
    },
    hidePeriodSelection () {
      this.periodSelection = false
    },
    handleChangePeriod: function (p) {
      this.hidePeriodSelection()
      this.period = p
    }
  }
}
</script>

<style scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.time-delay-input {
    display: inline-block;
    border: none;
    border-bottom: 2px solid #D51920;
    -moz-appearance: textfield;
    min-width: 36px;
    color: #111111;
    font-size: 28px;
    line-height: 34px;
    text-align: center;
}
.time-delay-period {
    color: #666666;
    font-size: 28px;
    line-height: 34px;
    text-align: left;
}
</style>
