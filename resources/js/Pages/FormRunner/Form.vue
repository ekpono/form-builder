<template>
  <div class="lg:flex h-screen">
    <Form
      ref="form"
      :form="form"
      :theme="theme"
      :order="order"
      :form-progress="formProgress"
      :chosen-order-items="chosenOrderItems"
      :is-mobile="isMobile"
      @update:progress="saveFormProgress"
      @update:orderItems="saveOrderItems"
      @update:goToForm="goToForm"
      @uploadFile="handleUploadFile"
    />
  </div>
</template>

<script>
import { usePage } from '@inertiajs/inertia-vue3'
import { QUESTION_CATEGORY_TYP } from '../../constants/Forms/questions'
import axios from 'axios'
import { uploadFile } from '../../functions'
import Form from '../../Components/FormRunner/Form'

let saveTimer

export default {
  components: { Form },
  data: function () {
    return {
      isMobile: screen.width <= 1024,
      form: usePage().props.value.form,
      theme: usePage().props.value.form.data?.theme,
      order: usePage().props.value.order,
      storeId: usePage().props.value.form.store_id,
      formsIdUuidMap: usePage().props.value.formsIdUuidMap,
      formProgress: usePage().props.value.formAnswers?.answers || [],
      chosenOrderItems: usePage().props.value.formAnswers?.order_items || [],
      path: usePage().props.value.path
    }
  },
  watch: {
    formProgress: {
      deep: true,
      handler: 'saveProgress'
    },
    chosenOrderItems: {
      deep: true,
      handler: 'saveProgress'
    }
  },
  created () {
    addEventListener('resize', this.setMobile)
  },
  unmounted () {
    removeEventListener('resize', this.setMobile)
  },
  methods: {
    saveFormProgress: function (newValue) {
      this.formProgress = newValue
    },
    saveOrderItems: function (newOrderItems) {
      this.chosenOrderItems = newOrderItems
    },
    goToForm: function (formId) {
      window.location.href = `${this.path}/form/${this.formsIdUuidMap[formId]}/${this.order.uuid}`
    },
    saveProgress: function () {
      clearTimeout(saveTimer)
      saveTimer = setTimeout(async () => {
        try {
          await axios.post(
            route('api.form-answers.store', [this.form.uuid, this.order.uuid]),
            {
              answers: this.formProgress,
              order_items: this.chosenOrderItems,
              params: this.paramsFromStoreAnswer(),
              ...(this.$refs.form.currentQuestion.category === QUESTION_CATEGORY_TYP ? { finished_at: new Date() } : {})
            },
            { headers: { 'X-Store-Id': this.storeId } }
          )
        } catch (e) {
          console.log(e)
          console.log(e.response?.data?.message || e.message)
        }
      }, 200)
    },
    setMobile: function () {
      this.isMobile = screen.width <= 1024
    },
    handleUploadFile: async function ({ files, cb }) {
      try {
        for (const file of files) {
          const path = await uploadFile(file, 'form-answers', this.storeId)
          cb([path])
        }
      } catch (e) {
        cb(null, e.response?.data || e.message)
      }
    },
    paramsFromStoreAnswer: function () {
      const p = {}
      for (const a of this.formProgress) {
        const storeAnswer = this.$refs.form.questions.find(q => a.questionId === q.id).storeAnswer
        if (!storeAnswer?.param) {
          continue
        }
        p[storeAnswer.param] = a.answers.map(answer => ({
          format: (storeAnswer.choices && storeAnswer.choices.length > 0 && storeAnswer.choices.find(c => c.id === answer.id).format) ||
                      'text',
          value: (storeAnswer.choices && storeAnswer.choices.length > 0 && storeAnswer.choices.find(c => c.id === answer.id).value) ||
                      answer.value
        })).pop()
      }
      return p
    }
  }
}
</script>

<style scoped>

</style>
