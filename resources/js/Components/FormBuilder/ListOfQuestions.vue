<template>
  <div class="my-3">
    <ListOfQuestionsItem
      is="div"
      v-for="(item, i) in kickOffs"
      :key="`question${i}`"
      :title="item.title"
      :category="item.category"
      :type="item.type"
      :index="item.index"
      @click="$emit('onClickItem', item)"
      @clickOptions="handleClickOptions(item.id, $event)"
    />
    <draggable
      v-for="(list, listName) in sortableItems"
      :key="`question-list${listName}`"
      tag="ul"
      :animation="200"
      @end="handleChangeSorting(listName, $event)"
    >
      <ListOfQuestionsItem
        is="li"
        v-for="(item, i) in list"
        :key="`question${listName}${i}${item.id}`"
        :title="item.title"
        :category="item.category"
        :type="item.type"
        :index="item.index"
        @click="$emit('onClickItem', item)"
        @clickOptions="handleClickOptions(item.id, $event)"
      />
    </draggable>
  </div>
</template>

<script>
import { VueDraggableNext } from 'vue-draggable-next'
import ListOfQuestionsItem from './ListOfQuestionsItem.vue'
import {
  QUESTION_CATEGORY_FOLLOW_UP,
  QUESTION_CATEGORY_KICK_OFF,
  QUESTION_CATEGORY_TYP
} from '@/constants/Forms/questions'

export default {
  name: 'ListOfQuestions',
  components: { ListOfQuestionsItem, draggable: VueDraggableNext },
  props: {
    items: { type: Array, default: () => ([]) }
  },
  emits: ['onClickItem', 'onChangeSorting', 'onClickOptions'],
  computed: {
    kickOffs: function () {
      return this.items.filter(i => i.category === QUESTION_CATEGORY_KICK_OFF)
    },
    sortableItems: function () {
      return {
        [QUESTION_CATEGORY_FOLLOW_UP + 's']: this.followUps,
        [QUESTION_CATEGORY_TYP + 's']: this.typs
      }
    },
    followUps: function () {
      return this.items.filter(i => i.category === QUESTION_CATEGORY_FOLLOW_UP)
    },
    typs: function () {
      return this.items.filter(i => i.category === QUESTION_CATEGORY_TYP)
    }
  },
  methods: {
    handleChangeSorting: function (questionCategory, { oldIndex, newIndex }) {
      oldIndex !== newIndex && this.$emit('onChangeSorting', questionCategory, oldIndex, newIndex)
    },
    handleClickOptions: function (id, y) {
      this.$emit('onClickOptions', id, y)
    }
  }
}
</script>

<style scoped>
</style>
