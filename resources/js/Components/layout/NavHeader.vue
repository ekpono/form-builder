<template>
  <div class="relative z-10 rounded-t flex-shrink-0 flex h-16 bg-white shadow-sm">
    <button
      class="
        px-4
        border-r border-gray-200
        text-gray-500
        focus:outline-none
        focus:ring-2 focus:ring-inset focus:ring-indigo-500
        md:hidden
      "
      @click="$emit('open-sidebar', true)"
    >
      <span class="sr-only">Open sidebar</span>
      <MenuAlt2Icon
        class="h-6 w-6"
        aria-hidden="true"
      />
    </button>
    <div
      class="
        flex-1
        px-4
        flex
        justify-between
        sm:px-6
        lg:mx-auto
        lg:px-2
      "
    >
      <div class="flex items-center flex-shrink-0 px-4 justify-center">
        <img
          v-if="! $page.props.sidebar"
          class="h-16 w-auto"
          :src="$page.props.config.logo"
          alt="Workflow"
        >
      </div>
      <AppSearch />
      <div class="ml-4 flex items-center md:ml-6 divide-x divide-gray-200">
        <!-- Profile dropdown -->
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
                mr-2
                items-center
                text-sm
                focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
                lg:px-2
                lg:rounded-md
                lg:hover:bg-gray-50
              "
            >
              <img
                class="h-12 w-12 rounded-full"
                :src="$page.props.config.company_logo"
                alt=""
              >
              <span
                class="hidden text-gray-700 text-sm font-medium lg:block"
              ><span class="sr-only">Open user menu for </span>blositive.nl</span>
              <ChevronDownIcon
                class="hidden flex-shrink-0 ml-1 h-5 w-5 text-navy lg:block"
                aria-hidden="true"
              />
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
                w-48
                rounded-md
                shadow-lg
                py-1
                bg-white
                ring-1 ring-black ring-opacity-5
                focus:outline-none
              "
            >
              <MenuItem v-slot="{ active }">
                <Link
                  href="/shops"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700'
                  ]"
                >
                  Add Store
                </Link>
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
        <!-- Profile dropdown -->
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
                mx-1
                items-center
                text-sm
                focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
                lg:px-2
                lg:rounded-md
                lg:hover:bg-gray-50
              "
            >
              <MailIcon class="w-10 h-10 text-gray-500" />
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
                w-48
                rounded-md
                shadow-lg
                py-1
                bg-white
                ring-1 ring-black ring-opacity-5
                focus:outline-none
              "
            >
              <MenuItem v-slot="{ active }">
                <a
                  href="#"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700'
                  ]"
                >Your Profile</a>
              </MenuItem>
            </MenuItems>
          </transition>
        </Menu>
        <!-- Profile dropdown -->
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
                ml-2
                focus:outline-none
                focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
                lg:py-1
                lg:pl-2
                lg:rounded-md
                lg:hover:bg-gray-50
              "
            >
              <img
                class="h-8 w-8 rounded-full"
                :src=$page.props.config.profile_picture
                alt=""
              >
              <span
                class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"
              ><span class="sr-only">Open user menu for </span></span>
              <ChevronDownIcon
                class="hidden flex-shrink-0 ml-1 h-5 w-5 text-navy lg:block"
                aria-hidden="true"
              />
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
                w-48
                rounded-md
                shadow-lg
                py-1
                bg-white
                ring-1 ring-black ring-opacity-5
                focus:outline-none
              "
            >
              <menu-item v-slot="{ active }">
                <a
                  href="#"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700'
                  ]"
                >Your Profile</a>
              </menu-item>
              <menu-item v-slot="{ active }">
                <a
                  href="#"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700'
                  ]"
                >Settings</a>
              </menu-item>
              <menu-item v-slot="{ active }">
                <Link
                  :href="route('logout')"
                  :class="[
                    active ? 'bg-gray-100' : '',
                    'block px-4 py-2 text-sm text-gray-700'
                  ]"
                  method="post"
                >
                  Logout
                </Link>
              </menu-item>
            </MenuItems>
          </transition>
        </Menu>
      </div>
    </div>
  </div>
</template>

<script>
import AppSearch from './../Ui/AppSearch.vue'
import { MenuAlt2Icon, MailIcon } from '@heroicons/vue/outline'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {
  name: 'NavHeader',
  components: {
    MenuAlt2Icon,
    AppSearch,
    ChevronDownIcon,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    MailIcon,
    Link
  },
  emits: ['open-sidebar'],
}
</script>
