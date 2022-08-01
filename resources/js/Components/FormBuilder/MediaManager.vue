<template>
  <div class="absolute left-0 top-0 bottom-0 right-0 z-50 overflow-hidden">
    <div class="bg-white px-5 rounded h-full flex flex-col">
      <div class="text-xl font-bold py-4 text-center">
        Add something nice
      </div>
      <Error
        v-if="error"
        class="justify-center"
      >
        {{ error }}
      </Error>
      <div class="py-3">
        <div class="rounded-lg overflow-hidden">
          <div class="md:flex">
            <div class="w-full">
              <div class="relative h-32 rounded-lg border-dashed border border-gray-400 bg-gray-100 flex justify-center items-center">
                <div class="absolute">
                  <div class="flex flex-col gap-1 items-center text-gray-500">
                    <AddMediaIcon
                      icon-color="currentColor"
                      height="32"
                      width="50"
                    />
                    <span class="block font-normal"><strong class="underline">Upload</strong> or drop image right here</span>
                  </div>
                </div>
                <input
                  type="file"
                  class="h-full w-full opacity-0"
                  name="mediamanager"
                  accept="image/*"
                  @change="handleUploadFile"
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        v-if="userFiles.length > 0"
        class="py-4 overflow-y-auto"
      >
        <div class="flex flex-wrap items-start">
          <div
            v-for="f in userFiles"
            :key="'media-manager-file-' + f"
            class="lg:w-1/4 cursor-pointer rounded border-2 overflow-hidden relative"
            :class="checked === f ? ['border-blue-600'] : ['border-transparent']"
            @click="handleClickFile(f)"
          >
            <div
              v-if="checked === f"
              class="check-icon-container absolute top-0 right-0 p-3"
            >
              <CheckIcon class="check-icon text-white h-6" />
            </div>
            <img
              :src="`/storage/${f}`"
              class="w-full"
              alt=""
            >
          </div>
        </div>
      </div>
      <div class="flex gap-2 justify-around py-4">
        <ActionButtons
          @click:ok="$emit('click:ok', checked); checked = null"
          @click:cancel="$emit('click:cancel')"
        />
      </div>
    </div>
  </div>
</template>

<script>
import AddMediaIcon from '../../Components/FormBuilder/Icons/AddMediaIcon'
import ActionButtons from '../../Components/FormBuilder/ActionButtons'
import Error from '../../Components/FormBuilder/Error'
import { CheckIcon } from '@heroicons/vue/outline'
export default {
  name: 'MediaManager',
  components: { Error, ActionButtons, AddMediaIcon, CheckIcon },
  props: {
    files: { type: Array, default: () => [] }
  },
  emits: ['click:ok', 'click:cancel', 'upload'],
  data () {
    return {
      checked: null,
      error: null,
      userFiles: this.files
    }
  },
  methods: {
    handleUploadFile: function (e) {
      this.error = null
      const file = e.target.files[0]
      if (!file) {
        return
      }
      if (file.size > 35 * 1024 * 1024) {
        this.error = 'File size must be less than 35MB'
        return
      }
      this.$emit(
        'upload',
        file,
        function (uploadedImage, err) {
          if (err) {
            this.error = err
            return
          }
          this.userFiles = [uploadedImage, ...this.userFiles]
          this.checked = uploadedImage
        }.bind(this)
      )
    },
    handleClickFile: function (file) {
      this.checked = this.checked === file ? null : file
    }
  }
}
</script>

<style scoped>
.check-icon-container {
    z-index: 1;
}
.check-icon-container:before {
    content: '';
    @apply bg-blue-600;
    position: absolute;
    z-index: -1;
    left: -150%;
    right: -150%;
    bottom: 0;
    top: -50%;
    transform: rotate(45deg);
}
</style>
