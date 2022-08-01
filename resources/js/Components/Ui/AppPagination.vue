<template>
  <nav
    class="
      border-t border-gray-200
      px-4
      flex
      items-center
      justify-between
      sm:px-2
    "
  >
    <div class="-mt-px w-0 flex-1 flex">
      <a
        href="#"
        :class="[smallSize ? 'text-xs' : ' text-sm']"
        class="
          border-t-2 border-transparent
          pt-4
          pr-1
          inline-flex
          items-center
          font-medium
          text-gray-500
          hover:text-gray-700
          hover:border-gray-300
        "
      >
        <ArrowNarrowLeftIcon
          :class="[smallSize ? 'h-3 w-3' : 'h-5 w-5']"
          class="mr-3 text-gray-400"
          aria-hidden="true"
        />
        Previous
      </a>
    </div>
    <div class="hidden md:-mt-px md:flex">
      <a v-for="(count, index) in pagesCount"
        :key="index"
        href="#"
        :class="[smallSize ? 'text-xs px-2' : 'text-sm px-4', currentPage === index + 1 ? 'border-indigo-500 text-indigo-600  hover:text-gray-700 hover:border-gray-300' : 'text-gray-500 hover:text-gray-700 hover:border-gray-300']"
        class="
          border-transparent
          border-t-2
          pt-4
          inline-flex
          items-center
          font-medium
        "
      >
        {{ index + 1 }}
      </a>
    </div>
    <div class="-mt-px w-0 flex-1 flex justify-end">
      <a
        href="#"
         :class="[smallSize ? 'text-xs' : 'text-sm']"
        class="
          border-t-2 border-transparent
          pt-4
          pl-1
          inline-flex
          items-center
          font-medium
          text-gray-500
          hover:text-gray-700
          hover:border-gray-300
        "
      >
        Next
        <ArrowNarrowRightIcon
          :class="[smallSize ? 'h-3 w-3' : 'h-5 w-5']"
          class="ml-3 text-gray-400"
          aria-hidden="true"
        />
      </a>
    </div>
  </nav>
</template>

<script>
import { ArrowNarrowLeftIcon, ArrowNarrowRightIcon } from '@heroicons/vue/solid'

export default {
  components: {
    ArrowNarrowLeftIcon,
    ArrowNarrowRightIcon
  },
  props: {
    pagesCount: {
      type: Number,
      default: 7
    },
    currentPage: {
      type: Number,
      default: 1
    },
    smallSize: {
      type: Boolean
    }
  }
}
</script>
