<template>
  <div class="sm:hidden">
    <label
      for="tabs"
      class="sr-only"
    >Select a tab</label>
    <select
      id="tabs"
      name="tabs"
      class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
    >
      <option
        v-for="tab in tabs"
        :key="tab.name"
        :selected="tab.current"
      >
        {{ tab.name }}
      </option>
    </select>
  </div>
  <div class="hidden sm:block">
    <div class="px-3 border-b border-gray-300">
      <nav
        class="flex space-x-4 py-3"
        aria-label="Tabs"
      >
        <Link
          v-for="tab in tabs"
          :key="tab.name"
          :href="tab.to"
          :class="[tab.to == $page.url ? 'border-indigo-500 text-navy' : 'border-transparent text-navy hover:text-indigo-700 hover:border-indigo-300', 'whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm']"
        >
          {{ tab.name }}
        </Link>
      </nav>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  name: 'AppTabs',
  components: {
    Link
  },
  props: {
    tabs: {
      type: Array,
      required: true
    }
  }
}
</script>
