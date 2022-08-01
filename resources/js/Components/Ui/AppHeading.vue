<template>
  <div class="rounded-b-lg pt-6 pb-2 px-3 mb-5 bg-white shadow">
    <div class="md:flex md:items-center md:justify-between">
      <div class="flex flex-col md:flex-row flex-1 min-w-0 md:items-center">
        <h2 class="text-2xl mb-3 md:mb-0 text-left font-semibold leading-7 text-gray-900 sm:truncate">
          {{ title }}
        </h2>
        <p
          v-if="subTitle"
          class="md:ml-4 text-navy font-light text-sm"
        >
          {{ subTitle }}
        </p>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <Menu
          as="div"
          class="ml-3 relative"
        >
          <div>
            <MenuButton
              class="
                max-w-xs
                bg-white
                rounded-full
                flex
                items-center
                text-sm
                focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
                lg:py-2
                lg:rounded-md
              "
            >
              <input
                id="data"
                type="text"
                name="date-menu"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300"
                placeholder="Jan 9, 2021 - Feb 9, 2021"
                :value="fullDate"
                readonly
              >
            </MenuButton>
          </div>
          <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
          >
            <MenuItems
              class="
                origin-top-right
                absolute
                right-0
                flex
                mt-2
                w-140
                z-10
                rounded-md
                shadow-lg
                py-1
                bg-white
                ring-1 ring-black ring-opacity-5
                focus:outline-none
              "
            >
              <MenuItem
                class="border-r border-gray-300"
              >
                <div class="flex items-center gap-2 p-4">
                  <div>
                    <div class="mb-2">
                      <input
                        id="begin-date"
                        v-model="beginDateLabel"
                        type="text"
                        name="begin-date"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Jan, 9 2021"
                        readonly
                        @click.stop
                      >
                    </div>
                    <DatePicker
                      v-model="beginDate"
                      is-required
                      @dayclick="beginDateInput"
                    />
                  </div>
                  <div>
                    <div class="mb-2">
                      <input
                        id="end-date"
                        v-model="endDateLabel"
                        type="text"
                        name="end-date"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Jan, 16 2021"
                        readonly
                        @click.stop
                      >
                    </div>
                    <DatePicker
                      v-model="endDate"
                      is-required
                      @dayclick="endDateInput"
                    />
                  </div>
                </div>
              </MenuItem>
              <MenuItem>
                <nav
                  class="bg-white p-3 h-72 overflow-y-scroll w-80"
                  aria-label="Sidebar"
                >
                  <a
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-navy hover:bg-gray-50 hover:text-gray-900', 'flex items-center px-3 py-2 text-sm font-light rounded-md']"
                    :aria-current="item.current ? 'page' : undefined"
                  >
                    <span class="truncate">
                      {{ item.name }}
                    </span>
                  </a>
                </nav>
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
        <Menu
          as="div"
          class="relative"
        >
          <div>
            <MenuButton
              class="
                max-w-xs
                bg-white
                rounded-full
                flex
                items-center
                text-sm
                z-10
                focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
                lg:py-2
                lg:rounded-md
                lg:hover:bg-gray-50
              "
            >
              <button class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                <MenuAlt2Icon
                  class="h-5 w-5 text-gray-400"
                  aria-hidden="true"
                />
              </button>
            </MenuButton>
          </div>
          <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
          >
            <MenuItems
              class="
                origin-top-right
                absolute
                right-0
                mt-2
                rounded-md
                shadow-lg
                py-1
                bg-white
                ring-1 ring-black ring-opacity-5
                focus:outline-none
              "
            >
              <MenuItem>
                <nav
                  class="bg-white p-3 h-56 overflow-y-scroll"
                  aria-label="Sidebar"
                >
                  <a
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-navy hover:bg-gray-50 hover:text-gray-900', 'flex items-center px-3 py-2 text-sm font-light rounded-md']"
                    :aria-current="item.current ? 'page' : undefined"
                  >
                    <span class="truncate">
                      {{ item.name }}
                    </span>
                  </a>
                </nav>
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, ref } from 'vue'
import { DatePicker } from 'v-calendar'
import { MenuAlt2Icon } from '@heroicons/vue/outline'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

const navigation = [
  { name: 'Today', href: '#', current: true },
  { name: 'Yesterday', href: '#', current: false },
  { name: 'This Week', href: '#', current: false },
  { name: 'This Month', href: '#', current: false },
  { name: 'Year To Date', href: '#', current: false },
  { name: 'Last Year', href: '#', current: false },
  { name: 'Last 7 Days', href: '#', current: false },
  { name: 'Last Wekk', href: '#', current: false },
  { name: 'Last Month', href: '#', current: false },
  { name: 'Last 6 Months', href: '#', current: false },
  { name: 'All Time', href: '#', current: false },
  { name: 'Custom Range', href: '#', current: false }
]

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec']

export default {
  name: 'AppHeading',
  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    MenuAlt2Icon,
    DatePicker
  },
  props: {
    title: {
      type: String,
      required: true,
      default: ''
    },
    subTitle: {
      type: String,
      default: ''
    }
  },
  setup () {
    const beginDate = ref(new Date())
    const endDate = ref(new Date())
    const beginDateLabel = ref('')
    const endDateLabel = ref('')

    const beginDateInput = e => {
      e.event.stopPropagation()
      beginDateLabel.value = `${months[e.month]} ${e.day}, ${e.year}`
    }
    const endDateInput = e => {
      e.event.stopPropagation()
      endDateLabel.value = `${months[e.month]} ${e.day}, ${e.year}`
    }

    const fullDate = computed(() => beginDateLabel.value && endDateLabel.value ? `${beginDateLabel.value} - ${endDateLabel.value}` : '')

    return {
      navigation,
      beginDate,
      beginDateLabel,
      endDateLabel,
      endDate,
      beginDateInput,
      endDateInput,
      fullDate
    }
  }
}
</script>

<style scoped>
  .w-140 {
    width: 43rem;
  }
</style>
