<template>
  <div class="max-w-7xl bg-gray-100 mx-auto sm:px-6 lg:px-8">
    <div class="h-screen gap-4 flex overflow-hidden">
      <TheSidebar
        v-if="sidebar"
        :open-sidebar="openSidebar"
        @open-sidebar="eventSide(false)"
      />
      <div class="flex flex-col w-0 flex-1 overflow-hidden py-4">
        <TheHeader @open-sidebar="eventSide" />
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import TheSidebar from './../Components/layout/TheSidebar.vue'
import TheHeader from './../Components/layout/TheHeader.vue'
import { ref } from 'vue'
export default {
  name: 'TheLayout',
  components: {
    TheSidebar,
    TheHeader
  },
  setup () {
    return {
      openSidebar: ref(false)
    }
  },
  computed: {
    sidebar () {
      return this.$page.props.sidebar
    }
  },
  methods: {
    eventSide (event) {
      this.openSidebar = event
    }
  }
}
</script>

<style>
</style>
