<template>
    <icon-base
        v-bind="$props"
        viewBox="0 0 9.4 6.1"
    >
        <path
            id="Path_36"
            fill="currentColor"
            d="M6.7,8.1,2,3.4,3.4,2,6.7,5.3,10,2l1.4,1.4Z"
            transform="translate(-2 -2)"
        />
    </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
    name: 'ArrowDownIcon',
    components: {
        IconBase
    },
    props: iconProps
}
</script>

<style scoped>
</style>
