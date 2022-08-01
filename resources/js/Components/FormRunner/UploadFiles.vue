<template>
  <div class="pt-2">
    <label class="block border-2 border-dashed border-gray-400 p-5 rounded-2xl text-center cursor-pointer relative z-10">
      <AddMediaIcon
        icon-color="#ccc"
        height="25"
        width="32"
      />
      <div class="text-gray-600 font-semibold pt-3">
        Drop your images or video file here, or click to browse (max. 35MB)
      </div>
      <div class="text-gray-400 text-md">
        Supports JPEG, PNG, MP4, and MOV
      </div>
      <input
        type="file"
        class="opacity-0 absolute z-10 top-0 left-0 right-0 bottom-0"
        accept="image/*, video/*"
        multiple
        @change="handleUploadFile"
      >
    </label>
    <div
      v-if="files.length > 0"
      class="mt-4 border border-gray-300 rounded"
    >
      <div
        v-for="file in files"
        :key="`file-upload-${file}`"
        class="px-3 py-2 flex gap-4 border-b last:border-0 text-sm"
      >
        <div class="w-full">
          <div class="flex justify-between">
            <div class="font-semibold">
              {{ file.slice(file.lastIndexOf('/') + 1) }}
            </div>
            <div class="text-gray-500 text-xs">
              Uploaded
            </div>
          </div>
          <div class="bg-red-600 h-2 rounded-2xl mt-1" />
        </div>
        <div class="bg-gray-200 rounded px-2 py-1">
          <TrashIcon
            icon-color="#888"
            height="16"
            width="13"
            @click="handleClickDelete(file)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddMediaIcon from '@/Components/FormBuilder/Icons/AddMediaIcon'
import TrashIcon from '@/Components/FormBuilder/Icons/TrashIcon'
export default {
  name: 'UploadFiles',
  components: { TrashIcon, AddMediaIcon },
  props: {
    initValue: { type: Array, default: () => ([]) }
  },
  emits: ['upload:file', 'update:value'],
  data: function () {
    return {
      error: null,
      files: this.initValue.map(a => a.value)
    }
  },
  mounted () {
    this.$emit('update:value', [{}])
  },
  methods: {
    handleUploadFile: function (e) {
      this.$emit(
        'upload:file',
        {
          files: e.target.files,
          cb: function (files, error) {
            if (error) {
              this.error = error
            }
            this.files = [...this.files, ...files]
            this.$emit('update:value', this.files.map(value => ({ value })))
          }.bind(this)
        }
      )
    },
    handleClickDelete: function (file) {
      this.files = this.files.filter(f => f !== file)
      this.$emit('update:value', this.files.map(value => ({ value })))
    }
  }
}
</script>

<style scoped>

</style>
