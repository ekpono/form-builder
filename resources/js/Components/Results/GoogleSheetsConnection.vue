<template>
  <a
    :href="hasGoogleIdentity || connected ? '' : route('auth.google.redirect', formId)"
    class="text-sm border rounded text-[#47c080] px-4 py-1 font-semibold duration-300 flex items-center"
    :class="[connected ? 'border-white cursor-default' : 'border-[#47c080] hover:bg-green-50']"
    @click="handleClick"
  >
    <div>{{ buttonText }}&nbsp;</div>
    <GoogleSheetsIcon class="h-5 w-5" />
  </a>
  <Modal
    v-if="error"
    @close="clearError"
  >
    <div class="pb-4">
      {{ error }}
    </div>
    <button
      class="px-8 py-1 bg-blue-500 rounded text-white font-bold"
      @click="clearError"
    >
      Ok
    </button>
  </Modal>
</template>

<script>
import GoogleSheetsIcon from '@/Components/FormBuilder/Icons/GoogleSheetsIcon'
import Modal from '@/Components/Modal'
import { delay } from '@/functions'
import axios from 'axios'

export default {
  name: 'GoogleSheetsConnection',
  components: { Modal, GoogleSheetsIcon },
  props: {
    formId: { type: Number, required: true },
    storeId: { type: Number, required: true },
    hasGoogleIdentity: { type: Boolean, default: false },
    hasGoogleSheetConnection: { type: Boolean, default: false }
  },
  data: function () {
    return {
      error: null,
      saving: false,
      connected: this.hasGoogleSheetConnection
    }
  },
  computed: {
    buttonText: function () {
      if (this.connected) {
        return 'Connected to'
      }
      return this.saving ? 'Connecting' : 'Connect to'
    }
  },
  methods: {
    handleClick: function (e) {
      if (!this.hasGoogleIdentity) {
        return
      }
      e.preventDefault()
      !this.connected && this.save()
    },
    save: async function () {
      if (this.saving) {
        return
      }
      this.saving = true
      try {
        await axios.post(
          route('api.google-sheets.create', this.formId),
          {},
          { headers: { 'X-Store-Id': this.storeId } }
        )
        this.connected = true
      } catch (e) {
        this.error = e.response?.data?.message || e.message
      }
      await delay(1000)
      this.saving = false
    },
    clearError: function () {
      this.error = null
    }
  }
}
</script>

<style scoped>

</style>
