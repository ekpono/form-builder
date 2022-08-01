<template>
  <div class="pointer-events-none">
    <svg class="w-full h-full block pointer-events-none">
      <g
        v-for="([x1, y1, x2, y2], i) in lines"
        :key="`flow-line-${i}`"
      >
        <line
          :x1="x1"
          :y1="y1"
          :x2="x2"
          :y2="y2"
        />
      </g>
    </svg>
  </div>
</template>

<script>

export default {
  name: 'FlowChart',
  props: {
    questions: { type: Object, required: true },
    answers: { type: Array, required: true }
  },
  data: function () {
    return {

    }
  },
  computed: {
    lines: function () {
      let engagedXCoordinates = []
      let engagedYCoordinates = []
      const lines = []
      for (const { x, y, toId, toForm } of this.answers) {
        if (!this.questionCoordinatesById(toId)) {
          continue
        }
        const [questionX1, questionX2, questionY] = this.questionCoordinatesById(toId)
        if (x >= questionX1 && x <= questionX2) {
          lines.push([x, y, x, questionY])
          continue
        }

        if (y + 40 >= questionY && y - 40 <= questionY) {
          lines.push(
            [x + 10, y - 10, questionX1 + 10, y - 10]
          )
          continue
        }

        let resX, resY
        [resX, engagedXCoordinates] = this.getFreeXCoord(questionX1 + 10, engagedXCoordinates);
        [resY, engagedYCoordinates] = this.getFreeYCoord(y + 10, engagedYCoordinates)

        lines.push(
          [x, y, x, resY],
          [x, resY, resX, resY],
          [resX, resY, resX, questionY]
        )
      }

      return lines
    }
  },
  methods: {
    questionCoordinatesByIndex: function (index) {
      const { x1, x2, y } = Object.values(this.questions).find(q => q.index === index)

      return [x1, x2, y]
    },

    questionCoordinatesById: function (id) {
      if (!this.questions[id]) {
        return null
      }
      const { x1, x2, y } = this.questions[id]
      return [x1, x2, y]
    },
    getFreeXCoord: function (x, engagedXCoordinates) {
      if (engagedXCoordinates.indexOf(x) === -1) {
        return [x, [...engagedXCoordinates, x]]
      }
      return this.getFreeXCoord(x + 20, engagedXCoordinates)
    },
    getFreeYCoord: function (y, engagedYCoordinates) {
      if (engagedYCoordinates.indexOf(y) === -1) {
        return [y, [...engagedYCoordinates, y]]
      }
      return this.getFreeXCoord(y + 10, engagedYCoordinates)
    }
  }
}
</script>

<style scoped>
 line {
    stroke: #BFBFBF;
     @apply pointer-events-auto;
 }
 line:hover {
     stroke: #6b7280;
     stroke-width: 3;
 }
</style>
