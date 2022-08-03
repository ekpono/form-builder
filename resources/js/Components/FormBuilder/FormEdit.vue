<template>
  <form
    class="py-2 w-full h-full bg-white flex flex-col justify-between overflow-hidden"
    @submit.prevent="handleSubmit"
  >
    <div class="overflow-y-auto pb-24 px-6 h-full">
      <div class="py-4 text-xl font-bold">
        {{ header }}
      </div>
      <label class="flex flex-col gap-1">
        <span class="text-gray-500 text-xxs">Name</span>
        <Input
          v-model="newName"
          requred
          class="py-2 px-2 border"
          :class="errors.name && 'border-red-600'"
          placeholder="Enter the form name"
        />
      </label>
      <div class="py-2">
        <SelectBox
          v-model="newStoreId"
          label="Shop"
          placeholder="Choose the shop"
          :items="shopsSelectBoxItems"
          classes="py-2.5"
        />
      </div>
      <div class="py-2">
        <SelectBox
          v-model="newType"
          label="Type"
          placeholder="Choose the type"
          :items="createSelectBoxItems(formTypes)"
          classes="py-2.5 capitalize"
        />
      </div>
      <div class="py-2">
        <SelectBox
          v-model="newCategory"
          label="Category"
          placeholder="Choose the type"
          :items="categoriesSelectBoxItems"
          classes="py-2.5 capitalize"
          @update:modelValue="handleFormCategoryChange"
        />
      </div>
      <div
        v-show="isProductsReviewForm"
        class="py-2"
      >
        <label class="flex gap-4">
          <div class="text-xxs text-gray-500">Add customers files upload form</div>
          <Checkbox
            v-model="allowUsersFiles"
            :checked="data.allow_users_files"
          />
        </label>
      </div>
    </div>
    <div class="px-6">
      <div
        v-show="errors.name"
        class="text-red-700"
      >
        {{ errors.name }}
      </div>
      <div class="flex gap-2 py-4">
        <ActionButtons
          @click:ok="handleSubmit"
          @click:cancel="$emit('click:cancel')"
        />
      </div>
    </div>
  </form>
</template>

<script>
import Input from '../../Components/Input'
import ActionButtons from '../../Components/FormBuilder/ActionButtons'
import SelectBox from '../../Components/SelectBox'
import {
  FORM_CATEGORY_PRE_REVIEW, FORM_CATEGORY_REVIEW,
  FORM_CATEGORY_TITLE, FORM_TYPE_PRODUCT,
  UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY
} from '../../constants/Forms/form'
import { filterFormQuestions, injectDefaultPreReviewYesNo } from '@/functions'
import { QUESTION_TYPE_YES_NO } from '../../constants/Forms/questions'
import { CHANGE_FORM_WARNING_MESSAGE } from '../../constants/Forms/messages'
import Checkbox from '../../Components/Checkbox'

export default {
  name: 'FormEdit',
  components: { Checkbox, SelectBox, Input, ActionButtons },
  props: {
    id: { type: Number, default: null },
    header: { type: String, default: () => 'Edit form' },
    stores: { type: Array, required: true },
    formTypes: { type: Array, required: true },
    formCategories: { type: Array, required: true },
    storeId: { type: Number, default: null },
    name: { type: String, default: '' },
    type: { type: String, default: (props) => props.formTypes[0] },
    category: { type: String, default: (props) => props.formCategories[0] },
    errors: { type: Object, default: () => ({}) },
    data: {
      type: Object,
      default: () => ({
        follow_ups: [],
        kick_offs: [],
        typs: [],
        logic: [],
        allow_users_files: false
      })
    },
    snapshot: {
      type: Object,
      default: () => ({
        follow_ups: [],
        kick_offs: [],
        typs: [],
        logic: [],
        allow_users_files: false
      })
    }
  },
  emits: ['submit', 'click:cancel'],
  data: function () {
    return {
      newName: this.name,
      newStoreId: this.storeId,
      submitting: false,
      newType: this.type,
      newCategory: this.category,
      allowUsersFiles: this.data.allow_users_files
    }
  },
  computed: {
    shopsSelectBoxItems: function () {
      return this.stores.map(s => ({ value: s.id, title: s.domain }))
    },
    categoriesSelectBoxItems: function () {
      return this.formCategories.map(c => ({ value: c, title: FORM_CATEGORY_TITLE[c] || c }))
    },
    isProductsReviewForm: function () {
      return this.newType === FORM_TYPE_PRODUCT && this.newCategory === FORM_CATEGORY_REVIEW
    }
  },
  watch: {
    errors: {
      deep: true,
      handler: function () {
        this.submitting = false
      }
    }
  },
  mounted: function () {
    if (this.shopsSelectBoxItems.length > 0 && !this.newStoreId) {
      this.newStoreId = this.shopsSelectBoxItems[0].value
    }
  },
  methods: {
    handleFormCategoryChange: function (v) {
      if (v === this.formCategory) {
        return
      }
      const questionsToOmit = UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY[v]

      if (
        v === FORM_CATEGORY_PRE_REVIEW &&
            [...this.data.kick_offs, ...this.data.follow_ups].find(q => questionsToOmit.indexOf(q.type) !== -1)
      ) {
        if (!confirm(CHANGE_FORM_WARNING_MESSAGE)) {
          this.newCategory = this.formCategory
        }
      }
    },
    handleSubmit: function () {
      if (this.submitting) {
        return
      }
      this.submitting = true

      let formData = filterFormQuestions(this.data, UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY[this.newCategory])
      formData.allow_users_files = this.isProductsReviewForm && this.allowUsersFiles
      let snapshot = this.snapshot
      if (this.newCategory === FORM_CATEGORY_PRE_REVIEW && (!this.data.kick_offs[0] || this.data.kick_offs[0].type !== QUESTION_TYPE_YES_NO)) {
        formData = injectDefaultPreReviewYesNo(formData)
        snapshot = formData
      }
      this.$emit('submit', {
        ...(this.id ? { id: this.id } : {}),
        name: this.newName,
        type: this.newType,
        category: this.newCategory,
        data: formData,
        storeId: this.newStoreId,
        snapshot: snapshot
      })
    },
    createSelectBoxItems: function (arrayOfStrings) {
      return [...arrayOfStrings].map(s => ({ title: s.replace('_', ' '), value: s }))
    }
  }
}
</script>

<style scoped>

</style>
