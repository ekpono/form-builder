<template>
  <Head :title="formName + ' - Form Builder'" />

  <div
    class="bg-white shadow"
  >
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between">
        <h2 class="flex font-semibold text-xl text-gray-800 leading-tight capitalize">
          {{ formCategoryTitle(formCategory) }}&nbsp;<span v-if="! editNameMode">form - {{ formName }}</span>
          <PencilAltIcon
              v-if="! editNameMode"
              class="ml-4 h-5 mx-auto mb-1 align-center cursor-pointer text-gray-400"
              @click="editNameMode = ! editNameMode"
          />
          <input
              v-if="editNameMode"
              id="template-name"
              v-model="formName"
              v-click-outside="handleOutsideOnEditNameActive"
              type="text"
              name="store-hash"
              class="shadow-sm ml-2 h-9 focus:ring-indigo-500 focus:border-indigo-500 inline-flex sm:text-sm border-gray-300 rounded-md"
              placeholder="Form Name"
              @keyup.enter="editNameMode = false"
          >
        </h2>
        <div
          class="text-xxs"
          :class="[saving ? 'text-gray-500' : 'text-green-600']"
        ><CheckCircleIcon class="h-5 mx-auto mb-1" />
          {{ saving ? 'Saving in progress' : 'Saved' }}
        </div>
        <div class="flex gap-3 items-center">
          <button
            class="border border-blue-600 rounded text-blue-600 px-6 py-1.5 font-semibold hover:text-blue-800 hover:border-blue-800 duration-300"
            @click="handleClickCancel"
          >
            Cancel
          </button>
          <button
            class="bg-blue-600 rounded text-white px-8 py-1.5 font-semibold hover:bg-blue-800 duration-300"
            @click="handleClickDone"
          >
            Done
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="h-full w-full py-2 mx-auto px-4">
    <div
      id="workspace"
      class="workspace relative h-full overflow-hidden"
    >
      <div class="rounded-l w-full flex pb-2 h-full overflow-hidden">
        <CanvasButton
          v-if="!canvasIsOpened"
          @onClick="setCentralPartView('canvas')"
        />
        <div
          class="w-1/6 min-w-[235px] bg-white py-4 pt-8 shadow-lg z-10 relative overflow-hidden flex flex-col justify-between"
          :class="centralPartView ? ['rounded-l'] : ['rounded']"
        >
          <div
            id="leftside"
            class="flex flex-col px-3 h-full"
            :class="doesShowAddingPopup || questionContextMenu ? ['overflow-hidden'] : ['overflow-y-auto']"
          >
            <label
              for="form-type-select"
              class="text-txtgray font-bold block text-center text-sm"
            >Form type</label>
            <SelectBox
              :model-value="formCategory"
              :items="formCategories.map(c => ({ value: c, title: formCategoryTitle(c) }))"
              classes="pl-3 pt-0 pb-0"
              @update:modelValue="handleChangeFormCategory"
            />
            <QuestionAddingButton
              id="questionAddingButton"
              @click="toggleAddingPopup"
            />
            <div>
              <ListOfQuestions
                :items="allQuestions"
                @on-click-item="setCurrentItem"
                @onClickOptions="showQuestionContextMenu"
                @onChangeSorting="handleChangeSorting"
              />
            </div>
          </div>
          <div class="pt-1 px-3 border-t bg-white">
            <div class="text-txtgray font-bold block text-center text-sm pb-2">
              Design options
            </div>
            <div class="flex justify-around">
              <button
                class="text-gray-500 hover:text-blue-600"
                @click="showMediaManager = true"
              >
                <AddMediaIcon
                  icon-color="currentColor"
                  height="28"
                  width="28"
                />
                <div class="text-xxs font-thin text-gray-400">
                  Add media
                </div>
              </button>
              <button
                class="text-gray-500 hover:text-blue-600"
                @click="handleClickDesignTheme"
              >
                <DesignThemeIcon
                  icon-color="currentColor"
                  height="28"
                  width="28"
                />
                <div class="text-xxs font-thin text-gray-400">
                  Design & Theme
                </div>
              </button>
            </div>
            <div class="pt-4 pb-2">
              <button
                class="bg-blue-600 rounded text-white text-xxs px-3 py-1.5 flex gap-2 m-auto"
                @click="showPreviewForm"
              >
                <PreviewIcon
                  icon-color="#fff"
                  height="13"
                />
                <span>Preview this form</span>
              </button>
            </div>
          </div>
        </div>
        <transition
          enter-active-class="transition ease-out duration-300"
          enter-from-class="transform -translate-x-full"
          enter-to-class="transform translate-x-0"
          leave-active-class="transition ease-in duration-75 absolute"
          leave-from-class="transform translate-x-0"
          leave-to-class="transform -translate-x-full"
        >
          <CentralPartView
            v-show="showCentralPart"
            :key="`central-part-view=${centralPartView}-${canvasIsOpened ? '' : currentQuestionId}`"
            class="rounded-r shadow"
            :class="[canvasIsOpened ? 'w-1/2 bg-[#F8F8F8]' : 'w-1/5 bg-white']"
            :view="centralPartView"
            :question="currentQuestion"
            :question-category="currentQuestionCategory"
            :questions="allQuestions"
            :logic="form.logic"
            :form-category="formCategory"
            :forms="forms"
            :theme="form.theme"
            @update:question="handleUpdateQuestion"
            @update:questionCategory="handleUpdateQuestionCategory"
            @update:logic="handleUpdateLogic"
            @update:currentQuestion="setCurrentItem"
            @click:addMedia="showMediaManager = true"
            @click:emoji="handleAddEmoji"
            @update:addMark="handleAddMark"
            @update:centralPartView="setCentralPartView"
            @update:theme="handleUpdateTheme"
            @click:close="hideCentralBlock"
            @update:go-to-logic-jump="handleGoToLogicJump"
            @update:go-to-form-transfer="handleGoToFormTransfer"
          />
        </transition>
        <div
          class="bg-white rounded flex-grow shadow relative overflow-hidden ml-2"
          :class="[canvasIsOpened ? 'w-1/3' : 'w-4/6']"
          :style="{backgroundColor: form.theme?.background}"
        >
          <div class="overflow-y-auto h-full pb-12 flex flex-col">
            <div>
              <QuestionNav
                class="bg-white"
                @update:offsetQuestion="offsetQuestion"
                @update:duplicateCurrentQuestion="duplicateQuestion(currentQuestionId)"
                @click:previewCurrentQuestion="showPreviewQuestion"
              />
              <QuestionView
                v-if="currentQuestionId"
                ref="QuestionView"
                :question="currentQuestion"
                :question-type="currentQuestionCategory"
                :index="allQuestions.find(q => q.id === currentQuestionId)?.index"
                :theme="form.theme"
                @update:question="handleUpdateQuestion"
                @update:duplicateCurrentQuestion="duplicateQuestion(currentQuestionId)"
                @spyCaret="caret = $event"
                @click:settings="toggleQuestionSettings"
              />
            </div>
            <div
              v-if="errors"
              class="h-full flex flex-col justify-center"
            >
              <Errors
                :errors="errors"
              />
            </div>
            <MenuBar
              :tight="canvasIsOpened"
              class="absolute left-0 right-0 bottom-0"
              @update:centralPartView="setCentralPartView"
              @update:deleteCurrentQuestion="deleteCurrentQuestion"
              @update:duplicateCurrentQuestion="duplicateQuestion(currentQuestionId)"
            />
          </div>
        </div>
      </div>
      <transition-group
        enter-active-class="transition ease-out duration-100"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95"
      >
        <QuestionAddingPopup
          v-if="doesShowAddingPopup"
          key="QuestionAddingPopup"
          v-click-outside="hideAddingPopup"
          :form-category="formCategory"
          @add-question="addQuestion"
          @add-kick-off="addKickOff"
          @add-typ="addTyp"
        />
        <QuestionContextMenu
          v-show="questionContextMenu"
          key="QuestionContextMenu"
          v-click-outside="hideQuestionContextMenu"
          v-bind="questionContextMenu"
          @click:delete="deleteQuestion"
          @click:duplicate="duplicateQuestion"
        />

        <MediaManager
          v-show="showMediaManager"
          key="MediaManager"
          :files="files"
          @click:ok="handleAddMedia"
          @click:cancel="showMediaManager = false"
          @upload="uploadFile"
        />
        <Modal
          v-if="modal"
          key="Modal"
          :buttons="modal?.buttons"
          @close="closeModal"
        >
          {{ modal?.content }}
        </Modal>
        <Preview
          v-if="previewType"
          key="Preview"
          :type="previewType"
          :question="currentQuestion"
          :form="form"
          :form-name="formName"
          :form-category="formCategory"
          @click:close="hidePreview"
        />
      </transition-group>
    </div>
  </div>
  <div
    v-if="disallowEditor"
    class="fixed z-50 left-0 right-0 top-0 bottom-0"
  />
</template>

<script>
import { v4 as uuid } from 'uuid'
import { Head, usePage } from '@inertiajs/inertia-vue3'
import MenuBar from './../../Components/FormBuilder/MenuBar'
import QuestionView from './../../Components/FormBuilder/QuestionView'
import ListOfQuestions from './../../Components/FormBuilder/ListOfQuestions'
import QuestionAddingButton from './../../Components/FormBuilder/QuestionAddingButton'
import QuestionAddingPopup from './../../Components/FormBuilder/QuestionAddingPopup'
import QuestionNav from './../../Components/FormBuilder/QuestionNav'
import {
  QUESTION_CATEGORY_FOLLOW_UP,
  QUESTION_CATEGORY_KICK_OFF,
  QUESTION_CATEGORY_TYP, QUESTION_TYPE_YES_NO
} from '../../constants/Forms/questions'
import vClickOutside from 'click-outside-vue3'
import QuestionContextMenu from './../../Components/FormBuilder/QuestionContextMenu'
import AddMediaIcon from './../../Components/FormBuilder/Icons/AddMediaIcon'
import DesignThemeIcon from './../../Components/FormBuilder/Icons/DesignThemeIcon'
import PreviewIcon from './../../Components/FormBuilder/Icons/PreviewIcon'
import MediaManager from './../../Components/FormBuilder/MediaManager'
import axios from 'axios'
import SelectBox from './../../Components/SelectBox'
import {
  FORM_CATEGORY_PRE_REVIEW,
  formCategoryTitle, PREVIEW_TYPE_FORM, PREVIEW_TYPE_QUESTION,
  UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY
} from '../../constants/Forms/form'
import {
  CHANGE_FORM_WARNING_MESSAGE,
  TRY_TO_DELETE_PRE_REVIEW_KICK_OFF_MESSAGE,
  PRE_REVIEW_FORM_TRANSFER_ERROR_MESSAGE,
  NO_TYPS_ERROR_MESSAGE
} from '../../constants/Forms/messages'
import { filterFormQuestions, injectDefaultPreReviewYesNo, uploadFile } from '@/functions'
import Modal from './../../Components/Modal'
import Errors from './../../Components/FormBuilder/QuestionErrors'
import CentralPartView from './../../Components/FormBuilder/CentralPartView'
import { CANVAS, DESIGN_THEME, QUESTION_SETTINGS } from '../../constants/Forms/centralPartViews'
import { CheckCircleIcon, PencilAltIcon } from '@heroicons/vue/solid'
import { delay } from 'lodash'
import Preview from './../../Components/FormBuilder/preview/Preview'
import CanvasButton from './../../Components/FormBuilder/Canvas/Button'
import TheLayout from '../../Layouts/TheLayout'
const STORAGE_KEY = 'crpFormBuilderState'

let setTimer

export default {
  components: {
    Preview,
    CentralPartView,
    Modal,
    SelectBox,
    AddMediaIcon,
    DesignThemeIcon,
    PreviewIcon,
    Head,
    MenuBar,
    QuestionView,
    ListOfQuestions,
    QuestionAddingButton,
    QuestionAddingPopup,
    QuestionNav,
    QuestionContextMenu,
    MediaManager,
    Errors,
    CanvasButton,
    CheckCircleIcon,
    PencilAltIcon
  },
  directives: {
    clickOutside: vClickOutside.directive
  },
  layout: TheLayout,
  data: () => ({
    formId: usePage().props.value.form.id,
    storeId: usePage().props.value.form.store_id,
    doesShowAddingPopup: false,
    questionContextMenu: null,
    form: usePage().props.value.form.data,
    formSnapshot: usePage().props.value.form.snapshot,
    formCategory: usePage().props.value.form.category,
    files: usePage().props.value.files,
    formName: usePage().props.value.form.name,
    currentQuestionId: null,
    centralPartView: null,
    showMediaManager: false,
    caret: { property: undefined, pos: 0 },
    modal: null,
    showCentralPart: false,
    saving: false,
    disallowEditor: false,
    previewType: null,
    showCanvas: false,
    editNameMode: false
  }),
  computed: {
    currentQuestionCategory: function () {
      return this.currentQuestion?.category
    },
    currentQuestion: function () {
      return this.allQuestions.find(q => q.id === this.currentQuestionId)
    },
    allQuestions: function () {
      return [
        ...(this.form.kick_offs[0] ? [{ ...this.form.kick_offs[0], category: QUESTION_CATEGORY_KICK_OFF, index: 1 }] : []),
        ...this.form.follow_ups.map((q, i) => ({ ...q, category: QUESTION_CATEGORY_FOLLOW_UP, index: i + 2 })),
        ...this.form.typs.map((typ, i) => ({ ...typ, category: 'typ', index: i + 1 }))
      ]
    },
    formCategories: () => usePage().props.value.formCategories,
    forms: () => usePage().props.value.forms,
    errors: function () {
      if (this.formCategory === FORM_CATEGORY_PRE_REVIEW) {
        const id = this.form.kick_offs[0]?.id
        if (!this.form.logic?.find(l => l.question_id === id && l.type === 'form')) {
          return PRE_REVIEW_FORM_TRANSFER_ERROR_MESSAGE
        }
        if (this.form.typs?.length === 0) {
          return NO_TYPS_ERROR_MESSAGE
        }
      }
      return undefined
    },
    canvasIsOpened: function () {
      return this.centralPartView === CANVAS && this.showCentralPart
    }
  },
  watch: {
    form: {
      deep: true,
      handler: 'saveForm'
    },
    formCategory: {
      handler: 'saveForm'
    },
    currentQuestionId: {
      handler: 'saveState'
    },
    centralPartView: {
      handler: 'saveState'
    },
    showCentralPart: {
      handler: 'saveState'
    }
  },
  mounted () {
    try {
      this.turnOffSideBar()
      const state = JSON.parse(localStorage.getItem(STORAGE_KEY))
      if (state.formId !== this.formId || !this.allQuestions.find(q => q.id === state.currentQuestionId)) {
        this.setCurrentItem(this.allQuestions[0])
        return
      }
      for (const f in state) {
        this[f] = state[f]
      }
    } catch (e) {}

    if (!this.formSnapshot) {
      this.formSnapshot = this.sanitizeForm(this.form)
      this.saveForm()
    }
  },
  methods: {
    turnOffSideBar () {
      usePage().props.value.sidebar = false
    },
    handleOutsideOnEditNameActive () {
      if (this.editNameMode) {
        this.editNameMode = false
      }
    },
    saveForm (cb) {
      clearTimeout(setTimer)
      setTimer = setTimeout(async () => {
        try {
          this.saving = true
          await axios.put(
            route('api.forms.update', this.formId),
            { data: this.sanitizeForm(this.form), category: this.formCategory, snapshot: this.formSnapshot, name: this.formName  },
            { headers: { 'X-Store-Id': this.storeId } }
          )
        } catch (e) {
          alert(e.response?.data || e.message)
        }
        setTimer = delay(() => { this.saving = false }, 1000)
        if (cb && typeof cb === 'function') {
          cb()
        }
      }, 300)
    },
    sanitizeForm (form) {
      const sanitized = { ...form }
      for (const d in sanitized) {
        if ([QUESTION_CATEGORY_KICK_OFF + 's', QUESTION_CATEGORY_FOLLOW_UP + 's', QUESTION_CATEGORY_TYP + 's'].indexOf(d) !== -1) {
          sanitized[d] = sanitized[d].map(({ category, index, ...q }) => q)
        }
      }
      return sanitized
    },
    saveState () {
      localStorage.setItem(STORAGE_KEY, JSON.stringify({
        formId: this.formId,
        currentQuestionId: this.currentQuestionId,
        centralPartView: this.centralPartView,
        showCentralPart: this.showCentralPart
      }))
    },
    handleUpdateQuestion (updated) {
      switch (this.currentQuestionCategory) {
        case QUESTION_CATEGORY_FOLLOW_UP:
          this.form.follow_ups = this.form.follow_ups.map(q => q.id === this.currentQuestionId ? updated : q)
          break
        case QUESTION_CATEGORY_KICK_OFF:
          this.form.kick_offs[0] = updated
          break
        case QUESTION_CATEGORY_TYP:
          this.form.typs = this.form.typs.map(q => q.id === this.currentQuestionId ? updated : q)
          break
      }
    },
    handleUpdateQuestionCategory (newCategory) {
      let eraseProperties = false
      if (this.currentQuestionCategory === QUESTION_CATEGORY_TYP || newCategory === QUESTION_CATEGORY_TYP) {
        if (confirm('are you sure?')) {
          eraseProperties = true
        } else {
          return
        }
      }
      if (newCategory === QUESTION_CATEGORY_KICK_OFF && this.form.kick_offs.length > 0) {
        return alert('You can add only one kick-off question')
      }

      const fromFieldName = this.currentQuestionCategory + 's'
      const toFieldName = newCategory + 's'
      const targetQuestion = this.form[fromFieldName].find(q => q.id === this.currentQuestionId)
      this.form[toFieldName] = [
        ...this.form[toFieldName],
        eraseProperties ? { ...targetQuestion, properties: {}, type: null } : targetQuestion
      ]
      this.form[fromFieldName] = this.form[fromFieldName].filter(q => q.id !== this.currentQuestionId)
      this.setCurrentItem({ ...targetQuestion })
    },
    addQuestion (q) {
      this.doesShowAddingPopup = false
      this.form.follow_ups = [...this.form.follow_ups, q]
      this.currentQuestionId = q.id
      this.setCurrentItem(q)
    },
    addKickOff (q) {
      this.doesShowAddingPopup = false
      if (this.form.kick_offs.length > 0) {
        return alert('You can add only one kick-off question')
      }
      this.form.kick_offs[0] = q
      this.setCurrentItem({ ...q, type: QUESTION_CATEGORY_KICK_OFF })
    },
    addTyp (q) {
      this.doesShowAddingPopup = false
      this.form.typs = [...this.form.typs, q]
      this.setCurrentItem({ ...q, type: QUESTION_CATEGORY_TYP })
    },
    toggleAddingPopup () {
      this.doesShowAddingPopup = !this.doesShowAddingPopup
    },
    hideAddingPopup (event) {
      if (event && (event.target.id === 'questionAddingButton' || event.target.closest('#questionAddingButton'))) {
        return
      }
      this.doesShowAddingPopup = false
    },
    setCurrentItem (q) {
      this.currentQuestionId = q.id
    },
    resetCurrentItem () {
      this.setCurrentItem(this.allQuestions[0])
    },
    setCentralPartView (viewName) {
      if (!this.currentQuestionId) {
        return
      }
      this.centralPartView = viewName
      this.showCentralPart = true
    },
    deleteCurrentQuestion () {
      this.deleteQuestionConfirm(this.currentQuestion.id)
    },
    offsetQuestion (offset) {
      if (!this.currentQuestionId) {
        return
      }
      const currentQuestionIndex = this.allQuestions.findIndex(q => q.id === this.currentQuestionId)
      const newQuestionIndex = currentQuestionIndex + offset
      if (newQuestionIndex > -1 && newQuestionIndex < this.allQuestions.length) {
        this.setCurrentItem(this.allQuestions[newQuestionIndex])
      }
    },
    handleUpdateLogic (updatedLogic) {
      this.form.logic = updatedLogic
    },
    handleChangeSorting (questionsList, oldPos, newPos) {
      this.form[questionsList].splice(newPos, 0, ...this.form[questionsList].splice(oldPos, 1))
    },
    showQuestionContextMenu (questionId, yCoord) {
      this.questionContextMenu = { questionId, yCoord }
    },
    hideQuestionContextMenu (event) {
      if (event && (event.target.id === 'questionContextMenuButton' || event.target.closest('#questionContextMenuButton'))) {
        return
      }
      this.questionContextMenu = null
    },
    deleteQuestionConfirm (id) {
      this.toggleModal(
        'Are you sure you want to delete this question?',
        [
          {
            text: 'Yes',
            primary: true,
            onClick: () => {
              this.deleteQuestion(id)
              this.closeModal()
            }
          },
          { text: 'No', onClick: this.closeModal.bind(this) }
        ]
      )
    },
    deleteQuestion (id) {
      if (id === this.currentQuestionId) {
        this.resetCurrentItem()
      }
      switch (this.allQuestions.find(q => q.id === id).category) {
        case QUESTION_CATEGORY_FOLLOW_UP:
          this.form.follow_ups = this.form.follow_ups.filter(q => q.id !== id)
          break
        case QUESTION_CATEGORY_KICK_OFF:
          if (this.formCategory === FORM_CATEGORY_PRE_REVIEW) {
            this.toggleModal(TRY_TO_DELETE_PRE_REVIEW_KICK_OFF_MESSAGE)
            return
          }
          this.form.kick_offs = []
          break
        case QUESTION_CATEGORY_TYP:
          this.form.typs = this.form.typs.filter(q => q.id !== id)
          break
      }
      this.form.logic = this.form.logic.filter(l => l.question_id !== id)
      this.hideQuestionContextMenu()
    },
    duplicateQuestion (id) {
      const category = this.allQuestions.find(q => q.id === id).category
      const q = this.form[category + 's'].find(q => q.id === id)
      const newQuestion = { ...q, id: uuid() }
      category === QUESTION_CATEGORY_TYP
        ? this.form.typs = [...this.form.typs, newQuestion]
        : this.form.follow_ups = [...this.form.follow_ups, newQuestion]

      this.hideQuestionContextMenu()
      this.setCurrentItem(newQuestion)
    },
    handleAddEmoji (e) {
      this.$refs.QuestionView.addEmojiAndFocus(e)
    },
    handleAddMark (mark) {
      this.$refs.QuestionView.inject(mark)
    },
    formCategoryTitle,
    handleChangeFormCategory: function (v) {
      if (v === this.formCategory) {
        return
      }
      const questionsToOmit = UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY[v]
      if (v === FORM_CATEGORY_PRE_REVIEW) {
        if (this.allQuestions.find(q => questionsToOmit.indexOf(q.type) !== -1)) {
          if (!confirm(CHANGE_FORM_WARNING_MESSAGE)) {
            return
          }
          if (questionsToOmit.indexOf(this.currentQuestion.type) !== -1) {
            this.resetCurrentItem()
          }
        }
        if (this.form.kick_offs[0]?.type !== QUESTION_TYPE_YES_NO) {
          this.form = injectDefaultPreReviewYesNo(filterFormQuestions(this.form, questionsToOmit))
        }
      }
      this.formCategory = v
    },
    toggleModal: function (content, buttons) {
      if (content === null) {
        this.modal = null
        return
      }
      this.modal = { content, buttons }
    },
    closeModal: function () {
      this.modal = null
    },
    hideCentralBlock: function () {
      this.showCentralPart = false
    },
    toggleQuestionSettings: function () {
      if (this.showCentralPart && this.centralPartView === QUESTION_SETTINGS) {
        this.showCentralPart = false
        return
      }
      this.centralPartView !== QUESTION_SETTINGS && (this.centralPartView = QUESTION_SETTINGS)
      !this.showCentralPart && (this.showCentralPart = true)
    },
    handleClickDone: function () {
      this.disallowEditor = true
      this.formSnapshot = this.sanitizeForm(this.form)
      setTimeout(() => {
        this.saveForm(() => {
          location.href = usePage().props.value.config.callback_url
        })
      }, 100)
    },
    handleClickCancel: function () {
      this.toggleModal(
        'Are you sure want to cancel?\nAll changes will be discarded',
        [
          {
            text: 'Yes, cancel',
            onClick: () => {
              this.form = this.formSnapshot
              this.handleClickDone()
            }
          },
          { text: 'No, continue editing', onClick: this.closeModal.bind(this) }
        ]
      )
    },
    uploadFile: async function (file, cb) {
      try {
        const path = await uploadFile(file, 'forms', this.storeId)
        cb(path)
      } catch (e) {
        cb(null, e.response?.data || e.message)
      }
    },
    handleAddMedia (src) {
      this.showMediaManager = false
      if (src) {
        this.handleUpdateQuestion({ ...this.currentQuestion, attachments: [{ type: 'image', src }] })
      }
    },
    handleClickDesignTheme () {
      this.setCentralPartView(DESIGN_THEME)
    },
    handleUpdateTheme (theme) {
      this.form.theme = theme
    },
    showPreviewQuestion () {
      this.previewType = PREVIEW_TYPE_QUESTION
    },
    showPreviewForm () {
      this.previewType = PREVIEW_TYPE_FORM
    },
    hidePreview () {
      this.previewType = null
    },
    handleToggleCanvas () {
      this.showCanvas = !this.showCanvas
    },
    handleGoToLogicJump (questionId) {
      if (questionId !== this.currentQuestionId) {
        this.setCurrentItem({ id: questionId })
      }
      this.setCentralPartView(LOGIC_JUMP)
    },
    handleGoToFormTransfer (questionId) {
      if (questionId !== this.currentQuestionId) {
        this.setCurrentItem({ id: questionId })
      }
      this.setCentralPartView(FORM_TRANSFER)
    }
  }
}
</script>
<style scoped>
.workspace {
  min-height: 300px;
}
</style>
