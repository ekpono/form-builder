<template>
    <icon-base
        v-bind="$props"
        viewBox="0 0 6.332 8.809"
    >
        <path d="M3.166,8.809a.521.521,0,0,1-.374-.156L.157,6.019a.522.522,0,0,1-.115-.578.524.524,0,0,1,.491-.329H5.8a.532.532,0,0,1,.376.907L3.542,8.653A.528.528,0,0,1,3.166,8.809ZM5.8,3.7H.533a.524.524,0,0,1-.491-.329.522.522,0,0,1,.115-.578L2.792.156A.521.521,0,0,1,3.166,0a.528.528,0,0,1,.376.156L6.175,2.789A.532.532,0,0,1,5.8,3.7Z" transform="translate(0 0)" fill="currentColor"/>
    </icon-base>
</template>

<script>
import IconBase, { iconProps } from './IconBase.vue'

export default {
    name: 'SortIcon',
    components: {
        IconBase
    },
    props: iconProps
}
</script>

<style scoped>
</style>
