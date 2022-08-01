<template>
    <div class="flex space-x-8">
        <div
            v-for="(tab, index) in tabs"
            :key="index"
        >
            <div
                class="text-base cursor-pointer"
                :class="activeTab === tab.value ? 'border-b-2 border-dsblue' : ''"
                @click="onChange(tab.value)"
            >
                {{ tab.label }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {
    },
    props: {
        tabs: {
            type: Array,
            default: () => []
        },
        activeTab: {
            type: String,
            default: ''
        }
    },
    methods: {
        onChange (value) {
            this.$emit('onChange', value)
        }
    }
}
</script>
