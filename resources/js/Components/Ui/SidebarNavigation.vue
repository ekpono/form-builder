<template>
  <div class="px-2 space-y-1">
    <component
      :is="'a'"
      v-for="(item, index) in navigation"
      :key="index"
      :href="item.to"
      :class="[
        item.to === $page.url
          ? 'text-blue-500'
          : 'text-navy hover:bg-gray-50 hover:text-gray-900',
        'group cursor-pointer flex items-center px-2 py-2 text-xs font-normal'
      ]"
    >
      <component
        :is="item.icon"
        :class="[
          item.to === $page.url
            ? 'text-blue-500'
            : 'text-navy group-hover:text-gray-500',
          'mr-2 flex-shrink-0 h-6 w-6'
        ]"
        aria-hidden="true"
      />
      {{ item.name }}
    </component>
  </div>
</template>

<script>
export default {
  name: 'SidebarNavigation',
  props: {
    navigation: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>
  .router-link-active,
  .router-link-active > svg,
  .router-link-exact-active,
  .router-link-exact-active > svg {
    @apply text-blue-500;
  }
</style>
