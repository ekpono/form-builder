<template>
  <div
    class="context-menu absolute bg-white border rounded z-40 text-xs"
    :style="{ top: yCoord + 'px'}"
  >
    <div
      v-for="option in options"
      :key="`question-context-menu${option}`"
      class="py-2 px-3 capitalize border-b cursor-pointer hover:bg-indigo-600 hover:text-white last:border-b-0 transition-all duration-300"
      @click="$emit(`click:${option.replaceAll(' ', '')}`, questionId)"
    >
      {{ option }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'QuestionContextMenu',
  props: {
    questionId: { type: String, default: '' },
    yCoord: { type: Number, default: 0 },
    options: { type: Array, default: () => (['duplicate', 'delete']) }
  },
  emits: ['click:duplicate', 'click:delete', 'click:gotologicjump']
}
</script>

<style scoped>
.context-menu {
    left: 16.666667%;;
}
.context-menu:before {
    content: '';
    position: absolute;
    left: -41px;
    top: 10px;
    border: 15px solid transparent;
    border-right: 25px solid #b7b7b7;
}
.context-menu:after {
    content: '';
    position: absolute;
    left: -40px;
    top: 10px;
    border: 15px solid transparent;
    border-right: 25px solid #fff;
}
</style>
