<template>
  <div class="flex-1 flex">
    <form
      class="w-full md:w-60 flex md:ml-0"
      action="#"
      method="GET"
    >
      <label
        for="search-field"
        class="sr-only"
      >Search</label>
      <div
        class="
          relative
          w-full
          text-navy
          focus-within:text-gray-600
          self-center
        "
      >
        <div
          class="
            absolute
            inset-y-0
            left-2
            flex
            items-center
            pointer-events-none
          "
          aria-hidden="true"
        >
          <SearchIcon
            class="h-5 w-5"
            aria-hidden="true"
          />
        </div>
        <input
          id="search-field"
          name="search-field"
          class="
            block
            w-full
            h-full
            pl-8
            border-gray-200
            pr-3
            py-2
            rounded-lg
            text-navy
            placeholder-navy
            sm:text-sm
          "
          placeholder="Search"
          type="search"
        >
      </div>
    </form>
  </div>
</template>

<script>
import { SearchIcon } from '@heroicons/vue/solid'
export default {
  name: 'AppSearch',
  components: {
    SearchIcon
  }
}
</script>

<style>

</style>
