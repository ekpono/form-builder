<template>
  <div class="relative group">
    <div
      class="tooltip absolute hidden group-hover:block z-40"
      :class="[firstRow ? 'top-full tooltip-bottom' : 'bottom-full']"
    >
      <div class="bg-navy text-white rounded px-2 py-1 text-xs">
        <table>
          <tbody>
            <tr>
              <td>
                <TYPIcon
                  v-if="QUESTION_CATEGORY_TYP === category"
                  class="h-6 pt-1"
                />
                <strong v-else>?</strong>
              </td>
              <td>{{ tooltipTitle || categoryTitle }}</td>
            </tr>
            <tr v-if="typeTitle">
              <td><ContrastIcon class="h-3 w-3 text-white" />&nbsp;</td>
              <td>{{ typeTitle }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div
      class="flex items-center question-list-item py-1 pl-2 pr-1 text-xs rounded-lg mt-1 cursor-pointer h-10"
      :class="`${category}`"
      @click="$emit('click')"
    >
      <div
        class="bg-white rounded-full font-bold w-7 h-7 flex items-center justify-around"
      >
        <ArrowLeftSquareIcon
          v-if="category === 'form-transfer'"
          class="h-4 w-4"
        />
        <small
          v-else
          class="font-bold"
        >{{ iconLetter }}{{ index }}</small>
      </div>
      <div class="w-2/3 ml-2 truncate">
        {{ title || 'No title' }}
      </div>
    </div>
    <button
      id="questionContextMenuButton"
      class="absolute right-0.5 top-0.5 bottom-0"
      @click="handleClickOptions"
    >
      <DotsVerticalIcon class="text-gray-500 w-4" />
    </button>
    <QuestionContextMenu
      v-if="showContextMenu"
      v-click-outside="hideContextMenu"
      :question-id="id"
      class="w-32"
      style="left: 110%"
      :options="['go to logic jump', '']"
      @click:gotologicjump="handleClickGotologicjump"
    />
  </div>
</template>

<script>
import ArrowLeftSquareIcon from '@/Components/FormBuilder/Icons/ArrowLeftSquareIcon'
import ContrastIcon from '@/Components/FormBuilder/Icons/ContrastIcon'
import TYPIcon from '@/Components/FormBuilder/Icons/TYPIcon'
import QuestionContextMenu from '@/Components/FormBuilder/QuestionContextMenu'
import { QUESTION_CATEGORY_NAME, QUESTION_CATEGORY_TYP, QUESTION_TYPE_NAME } from '@/constants/Forms/questions'
import { DotsVerticalIcon } from '@heroicons/vue/outline'
import vClickOutside from 'click-outside-vue3'

export default {
  name: 'QuestionCard',
  components: {
    QuestionContextMenu,
    DotsVerticalIcon,
    ContrastIcon,
    TYPIcon,
    ArrowLeftSquareIcon
  },
  directives: {
    clickOutside: vClickOutside.directive
  },
  props: {
    title: { type: String, default: '' },
    id: { type: [Number, String], default: undefined },
    tooltipTitle: { type: String, default: '' },
    index: { type: Number, default: null },
    category: { type: String, required: true },
    questionType: { type: String, default: () => '' },
    firstRow: { type: Boolean, default: false }
  },
  emits: ['click', 'clickOptions', 'click:goToLogicJump'],
  data: function () {
    return {
      QUESTION_CATEGORY_TYP,
      showContextMenu: false
    }
  },
  computed: {
    iconLetter: function () {
      return this.category === QUESTION_CATEGORY_TYP ? 'TP' : 'Q'
    },
    categoryTitle: function () {
      return QUESTION_CATEGORY_NAME[this.category]
    },
    typeTitle: function () {
      return QUESTION_TYPE_NAME[this.questionType]
    }
  },
  methods: {
    handleClickOptions: function () {
      this.showContextMenu = true
    },
    hideContextMenu: function () {
      this.showContextMenu = false
    },
    handleClickGotologicjump: function (id) {
      this.$emit('click:goToLogicJump', id)
    }
  }
}
</script>

<style scoped>
.question-list-item.kick_off {
    background: #EEC85E;
}
.question-list-item.typ {
    background: #50D66A;
}
.question-list-item.follow_up {
    background: #BFBFBF;
}
.question-list-item.form-transfer {
    background: #CDCCD7;
}
.tooltip {
    padding-bottom: 7px;
}
.tooltip.tooltip-bottom {
    padding-bottom: 0px;
    padding-top: 7px;
}

.tooltip:after {
    content: '';
    position: absolute;
    display: inline-block;
    border: 10px solid transparent;
    border-top: 13px solid rgb(5, 0, 56);
    left: 10px;
    bottom: -15px;
}
.tooltip.tooltip-bottom:after {
    border: 10px solid transparent;
    border-bottom: 13px solid rgb(5, 0, 56);
    left: 10px;
    top: -15px;
    bottom: auto;
}
</style>
