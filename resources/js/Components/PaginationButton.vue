<template>
    <div
        class="cursor-pointer px-2 py-3"
        :class="active ? 'border-t-2 border-dsblue text-dsblue' : 'hover:border-t-2 hover:border-dsblue hover:text-dsblue'"
        @click="$emit('change', page)"
    >
        {{ page }}
    </div>
</template>

<script>
export default {
    props: {
        page: {
            type: Number,
            default: 1
        },
        active: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['change']
}
</script>
