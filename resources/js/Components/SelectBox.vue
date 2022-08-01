<template>
  <Listbox
    as="div"
    :disabled="disabled"
    @update:modelValue="$emit('update:modelValue', $event)"
  >
    <ListboxLabel
      v-if="label"
      class="block text-txtgray font-semibold mb-3"
      style="font-size: 11px"
    >
      {{ label }}:
    </ListboxLabel>
    <div class="relative">
      <ListboxButton
        class="relative w-full border border-gray-300 rounded-md shadow-sm pl-1 pr-10 py-1 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        :class="[disabled ? 'bg-gray-100' : 'bg-white', classes]"
      >
        <span class="flex items-center">
          <QuestionLabel
            v-if="!selected && haveIcons"
            class="bg-gray-200  mr-3"
            :height="5"
            :width="6"
          />
          <QuestionLabel
            v-if="selected?.icon"
            class="bg-gray-300 mr-3"
            :class="selected.icon.style"
            :height="5"
            :width="6"
          >
            <component
              :is="selected.icon.component"
              :height="selected.icon.height || 9"
            />
          </QuestionLabel>
          <span
            class="block truncate"
            :style="{ fontSize: fontSize + 'px' }"
          >{{ selected?.title || placeholder }}</span>
        </span>
        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <ChevronDownIcon
            class="h-5 w-5 text-gray-400"
            aria-hidden="true"
          />
        </span>
      </ListboxButton>

      <transition
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
          <ListboxOption
            v-for="(item, i) in items"
            :key="`selectbox${i}${item.value}`"
            v-slot="{ active, selected }"
            as="template"
            :value="item.value"
          >
            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-3 border-gray-100 border-b last:border-0']">
              <div class="flex items-center">
                <QuestionLabel
                  v-if="item.icon"
                  class="bg-gray-300 mr-3"
                  :class="item.icon.style"
                  :height="5"
                  :width="6"
                >
                  <component
                    :is="item.icon.component"
                    :height="item.icon.height || 9"
                  />
                </QuestionLabel>
                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                  {{ item.title }}
                </span>
              </div>

              <span
                v-if="selected"
                :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']"
              >
                <CheckIcon
                  class="h-5 w-5"
                  aria-hidden="true"
                />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script>
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronDownIcon } from '@heroicons/vue/solid'
import QuestionLabel from './FormBuilder/QuestionLabel.vue'

export default {
  name: 'SelectBox',
  components: {
    QuestionLabel,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    ChevronDownIcon
  },
  props: {
    items: Array,
    modelValue: { type: [String, Number], default: null },
    label: String,
    placeholder: { type: String, default: 'Choose option' },
    disabled: Boolean,
    classes: { type: String, default: '' },
    fontSize: { type: Number, default: undefined }
  },
  emits: ['update:modelValue'],
  computed: {
    selected: function () {
      return this.items.find(i => i.value + '' === this.modelValue + '')
    },
    haveIcons: function () {
      return !!this.items.find(i => i.icon)
    }
  }
}
</script>

<style scoped>
</style>
