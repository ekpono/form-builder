<template>
    <icon-base
        v-bind="$props"
        viewBox="0 0 13.7 13.71"
    >
        <g id="add" transform="translate(1.128 1.13)">
            <path d="M0,0v11.46" transform="translate(5.725)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.25"/>
            <path d="M11.447,0H0" transform="translate(0 5.725)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.25"/>
        </g>
    </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
    name: 'PlusIcon',
    components: {
        IconBase
    },
    props: iconProps
}
</script>

<style scoped>
</style>
