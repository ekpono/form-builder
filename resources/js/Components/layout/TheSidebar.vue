<template>
  <TransitionRoot
    as="template"
    :show="sidebarOpen"
  >
    <Dialog
      as="div"
      static
      class="fixed inset-0 flex z-40 md:hidden"
      :open="sidebarOpen"
      @close="$emit('open-sidebar', false)"
    >
      <TransitionChild
        as="template"
        enter="transition-opacity ease-linear duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity ease-linear duration-300"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
      </TransitionChild>
      <TransitionChild
        as="template"
        enter="transition ease-in-out duration-300 transform"
        enter-from="-translate-x-full"
        enter-to="translate-x-0"
        leave="transition ease-in-out duration-300 transform"
        leave-from="translate-x-0"
        leave-to="-translate-x-full"
      >
        <div
          class="
            relative
            flex-1 flex flex-col
            max-w-xs
            w-full
            pt-5
            pb-4
            bg-white
          "
        >
          <TransitionChild
            as="template"
            enter="ease-in-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in-out duration-300"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <div class="absolute top-0 right-0 -mr-12 pt-2">
              <button
                class="
                  ml-1
                  flex
                  items-center
                  justify-center
                  h-10
                  w-10
                  rounded-full
                  focus:outline-none
                  focus:ring-2 focus:ring-inset focus:ring-white
                "
                @click="$emit('open-sidebar', false)"
              >
                <span class="sr-only">Close sidebar</span>
                <XIcon
                  class="h-6 w-6 text-white"
                  aria-hidden="true"
                />
              </button>
            </div>
          </TransitionChild>
          <div class="flex-shrink-0 flex items-center px-4">
            <img
              class="h-12 w-auto"
              src="/vendor/form-builder/images/logo.png"
              alt="Workflow"
            >
          </div>
          <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav
              class="
              flex-1 flex flex-col
              divide-y divide-gray-200
              overflow-y-auto
            "
            >
              <SidebarNavigation :navigation="navigation" />
              <div class="mt-3 py-3">
                <SidebarNavigation :navigation="secondaryNavigation" />
              </div>
              <div class="mt-3 py-3">
                <SidebarNavigation :navigation="thirdNavigation" />
              </div>
              <div class="mt-3 py-3">
                <SidebarNavigation :navigation="fourNavigation" />
              </div>
              <div class="mt-3 py-3">
                <SidebarNavigation :navigation="fiveNavigation" />
              </div>
              <div class="mt-3 py-3">
                <SidebarNavigation :navigation="sixNavigation" />
              </div>
            </nav>
          </div>
        </div>
      </TransitionChild>
      <div
        class="flex-shrink-0 w-14"
        aria-hidden="true"
      >
        <!-- Dummy element to force sidebar to shrink to fit close icon -->
      </div>
    </Dialog>
  </TransitionRoot>

  <!-- Static sidebar for desktop -->
  <div class="hidden py-4 md:flex md:flex-shrink-0">
    <div class="flex flex-col w-52">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div
        class="
          flex flex-col flex-grow
          border-r border-gray-200
          pt-5
          pb-4
          bg-white
          rounded
          overflow-y-auto
        "
      >
        <div class="flex items-center flex-shrink-0 px-4 justify-center">
          <img
            class="h-16 w-auto"
            src="/vendor/form-builder/images/logo.png"
            alt="Workflow"
          >
        </div>
        <div class="mt-10 flex-grow flex flex-col overflow-y-auto">
          <nav
            class="
              flex-1 flex flex-col
              divide-y divide-gray-200
              overflow-y-auto
            "
          >
            <SidebarNavigation :navigation="navigation" />
            <div class="mt-3 py-3">
              <SidebarNavigation :navigation="secondaryNavigation" />
            </div>
            <div class="mt-3 py-3">
              <SidebarNavigation :navigation="thirdNavigation" />
            </div>
            <div class="mt-3 py-3">
              <SidebarNavigation :navigation="fourNavigation" />
            </div>
            <div class="mt-3 py-3">
              <SidebarNavigation :navigation="fiveNavigation" />
            </div>
            <div class="mt-3 py-3">
              <SidebarNavigation :navigation="sixNavigation" />
            </div>
            <!-- Dummy element to force sidebar to has last border bottom -->
            <span />
          </nav>
        </div>
      </div>
    </div>,
  </div>
</template>

<script>
import { watch, ref } from 'vue'
import SidebarNavigation from '../Ui/SidebarNavigation.vue'
import {
  HomeIcon,
  XIcon,
  CogIcon,
  ChatAltIcon,
  CollectionIcon,
  AdjustmentsIcon,
  TemplateIcon,
  LightBulbIcon,
  PencilIcon,
  StarIcon,
  ViewGridIcon,
  PuzzleIcon,
  InformationCircleIcon
} from '@heroicons/vue/outline'

import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot
} from '@headlessui/vue'

const navigation = [
  { name: 'Dashboard', to: '/dashboard', icon: HomeIcon, current: true },
  { name: 'Feedback Insights', to: '/feedback-insights', icon: ChatAltIcon, current: false }
]

const secondaryNavigation = [
  { name: 'E-CRM', to: '/e-crm', icon: CogIcon },
  { name: 'Product & Assets Library', to: '/product-assets-library', icon: CollectionIcon }
]

const thirdNavigation = [
  { name: 'Feedback Collection Settings', to: '', icon: AdjustmentsIcon },
  { name: 'Templates', to: '/templates', icon: TemplateIcon }
]

const fourNavigation = [
  { name: 'Automated Campaigns', to: '/automated-campaigns', icon: LightBulbIcon },
  { name: 'Manual Campaigns', to: '/manual-campaigns', icon: PencilIcon }
]

const fiveNavigation = [
  { name: 'Reviews showcase page', to: '/reviews-showcase', icon: StarIcon },
  { name: 'Reviews Widgets', to: '/reviews-widget', icon: ViewGridIcon },
  { name: 'Reviews API', to: '/reviews-api', icon: PuzzleIcon }
]

const sixNavigation = [
  { name: 'Resources & Info', to: '/resources-info', icon: InformationCircleIcon }
]

const userNavigation = [
  { name: 'Your Profile', href: '' },
  { name: 'Settings', href: '' },
  { name: 'Sign out', href: '' }
]

export default {
  name: 'TheSidebar',
  components: {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    XIcon,
    SidebarNavigation
  },
  props: {
    openSidebar: {
      type: Boolean,
      default: false
    }
  },
  emits: ['open-sidebar'],
  setup (props, ctx) {
    const sidebarOpen = ref(false)
    watch(() => props.openSidebar, (first, second) => {
      console.log(
        'Watch props.selected function called with args:',
        first,
        second
      )
      sidebarOpen.value = first
    })
    return {
      navigation,
      secondaryNavigation,
      sidebarOpen,
      thirdNavigation,
      fourNavigation,
      fiveNavigation,
      sixNavigation,
      userNavigation
    }
  }
}
</script>

<style>
</style>
