<template>
  <div class="flex justify-center">
    <nav
      class="bg-white p-3 flex menu-bar justify-between rounded max-w-full"
      :class="[tight ? '' : 'gap-2']"
    >
      <div
        class="px-2 cursor-pointer"
        data-title="Delete"
        @click="$emit('update:deleteCurrentQuestion')"
      >
        <TrashIcon
          width="21"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Settings"
        @click="$emit('update:centralPartView', QUESTION_SETTINGS)"
      >
        <GearIcon
          width="27"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Logic jump"
        @click="$emit('update:centralPartView', LOGIC_JUMP)"
      >
        <JumpIcon
          width="32"
          height="18"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Transfer"
        @click="$emit('update:centralPartView', FORM_TRANSFER)"
      >
        <ArrowLeftSquareIcon
          width="27"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Recall info"
        @click="$emit('update:centralPartView', RECALL_INFO)"
      >
        <CollectionIcon
          width="31"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Store Answer"
        @click="$emit('update:centralPartView', STORE_ANSWER)"
      >
        <SaveAllIcon
          width="27"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Merge Tags"
        @click="$emit('update:centralPartView', MERGE_TAGS)"
      >
        <TagIcon
          width="25"
          height="27"
        />
      </div>
      <div
        class="px-2 cursor-pointer"
        data-title="Add Emoji"
        @click="$emit('update:centralPartView', ADD_EMOJI)"
      >
        <AddEmojyIcon
          width="26"
          height="26"
        />
      </div>
      <!--      <div-->
      <!--        class="px-2 cursor-pointer"-->
      <!--        data-title="Hyperlink"-->
      <!--        @click="$emit('update:centralPartView', HYPERLINK)"-->
      <!--      >-->
      <!--        <LinkIcon-->
      <!--          width="24"-->
      <!--          height="24"-->
      <!--        />-->
      <!--      </div>-->
      <div
        class="px-2 cursor-pointer"
        data-title="Duplicate"
        @click="$emit('update:duplicateCurrentQuestion')"
      >
        <DuplicateIcon
          width="25"
          height="25"
        />
      </div>
    </nav>
  </div>
</template>

<script>
import TrashIcon from './Icons/TrashIcon.vue'
import JumpIcon from './Icons/JumpIcon.vue'
import GearIcon from './Icons/GearIcon.vue'
import ArrowLeftSquareIcon from './Icons/ArrowLeftSquareIcon.vue'
import CollectionIcon from './Icons/CollectionIcon.vue'
import TagIcon from './Icons/TagIcon.vue'
import SaveAllIcon from './Icons/SaveAllIcon.vue'
import AddEmojyIcon from './Icons/AddEmojyIcon.vue'
import LinkIcon from './Icons/LinkIcon.vue'
import DuplicateIcon from './Icons/DuplicateIcon.vue'
import { LOGIC_JUMP, QUESTION_SETTINGS, FORM_TRANSFER, ADD_EMOJI, HYPERLINK, RECALL_INFO, MERGE_TAGS, STORE_ANSWER } from '../../constants/Forms/centralPartViews'

export default {
  name: 'MenuBar',
  components: {
    TrashIcon,
    ArrowLeftSquareIcon,
    JumpIcon,
    GearIcon,
    CollectionIcon,
    TagIcon,
    SaveAllIcon,
    AddEmojyIcon,
    LinkIcon,
    DuplicateIcon
  },
  props: {
    tight: { type: Boolean, default: false }
  },
  emits: ['update:centralPartView', 'update:deleteCurrentQuestion', 'update:duplicateCurrentQuestion'],
  data: () => ({
    QUESTION_SETTINGS,
    LOGIC_JUMP,
    FORM_TRANSFER,
    ADD_EMOJI,
    HYPERLINK,
    RECALL_INFO,
    MERGE_TAGS,
    STORE_ANSWER
  })
}
</script>

<style scoped>
  .menu-bar {
    margin-bottom: 1px;
    box-shadow: 1px 1px 16px #0000001F;
  }
  [data-title] {
    position: relative;
  }
  [data-title]:before {
    content: attr(data-title);
    position: absolute;
    bottom: 170%;
    display: block;
    white-space: nowrap;
    opacity: 0;
    font-size: 9px;
    letter-spacing: 0px;
    @apply bg-navy;
    @apply text-white;
    @apply rounded;
    @apply text-xs;
    @apply transition-all;
    @apply py-2 px-1;
  }
  [data-title]:before, [data-title]:after {
      left: 50%;
      pointer-events: none;
      transition-delay: .3s;
      transition-duration: .3s;
      transition-property: all;
      transform: translateX(-50%) translateY(50%);
  }
  [data-title]:after {
      content: '';
      position: absolute;
      bottom: 70%;
      opacity: 0;
      border: 14px solid transparent; border-top: 20px solid rgb(5, 0, 56);
  }
  [data-title]:hover:before, [data-title]:hover:after {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }
</style>
