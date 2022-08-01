<template>
  <div>
    <div
      v-for="(question, index) in questions"
      :key="question.id"
    >
      <div class="flex gap-5">
        <div class="w-1/12">
          <div class="bg-kick_off px-4 py-1 rounded font-bold inline-block">
            Q{{ index + 1 }}
          </div>
        </div>
        <div class="pt-1 pb-4 border-b border-gray-200 w-11/12">
          <div class="text-lg font-bold">
            {{ question.title }}
          </div>
          <div class="text-gray-400 pb-4">
            {{ countedSummary[question.id]?.amount || 0 }} people answered this question
          </div>
          <div class="py-4">
            <div
              v-for="variant in sortedSummary[question.id]"
              :key="`variant-${question.id}-${variant.id}`"
              class="pb-4"
            >
              <div class="flex gap-2 justify-between">
                <div>{{ variant.label || variant[0] }}</div>
                <div class="flex items-center gap-4 text-gray-400">
                  <div class="text-sm">
                    {{ (summary[question.id] && summary[question.id][variant.label || variant[0]]) || 0 }} resp.
                  </div>
                  <div class="font-bold text-gray-500">
                    {{ countedSummary[question.id]?.percentage[variant.label || variant[0]] || 0 }}%
                  </div>
                </div>
              </div>
              <div class="h-6 bg-gray-100 rounded overflow-hidden mt-2">
                <div
                  class="h-full bg-cyan-700"
                  :style="{width: `${countedSummary[question.id]?.percentage[variant.label || variant[0]] || 0}%`}"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const MAX_VARIANTS_NUMBER = 10

export default {
  props: {
    form: { type: Object, required: true },
    summary: { type: Object, required: true }
  },
  computed: {
    questions: function () {
      return [...this.form.data.kick_offs, ...this.form.data.follow_ups]
    },
    sortedSummary: function () {
      const result = {}
      for (const q in this.summary) {
        result[q] = Object.entries({ ...this.questionChoices(q), ...this.summary[q] }).sort(([, a], [, b]) => b - a)
        if (result[q].length > MAX_VARIANTS_NUMBER) {
          result[q] = [
            ...result[q].slice(0, MAX_VARIANTS_NUMBER),
            ['others', result[q].slice(MAX_VARIANTS_NUMBER).reduce((sum, r) => sum + r[1], 0)]
          ]
        }
      }

      return result
    },
    countedSummary: function () {
      const s = {}
      for (const itemKey in this.sortedSummary) {
        const amount = Object.values(this.summary[itemKey]).reduce((sum, a) => sum + a, 0)
        s[itemKey] = {
          amount,
          percentage: this.sortedSummary[itemKey]
            .reduce((r, i) => ({
              ...r,
              [i[0]]: (i[1] / amount * 100).toFixed(0)
            }), {})
        }
      }
      return s
    }
  },
  methods: {
    questionChoices: function (id) {
      return Object.fromEntries(this.questions.find(q => q.id === id)?.properties?.choices?.map(c => [c.label, 0]) || [])
    }
  }
}
</script>

<style scoped>

</style>
