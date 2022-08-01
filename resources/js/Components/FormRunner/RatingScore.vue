<template>
  <div
    class="flex flex-col lg:flex-row gap-4 mx-auto lg:mx-0 lg:items-start question"
    :class="[isMobile ? `width-mobile` : '']"
  >
    <div
      class="increment-button hidden lg:flex items-center justify-center"
      @click="handleIncrementScore(-.5)"
    >
      <MinusIcon class="increment-button-icon" />
    </div>
    <div class="relative w-full stars-block">
      <div class="flex gap-2 sm:gap-4">
        <div
          v-for="i in amountOfRatingBlocks"
          :key="`rating-score-star${i}`"
          class="rating-button relative"
        >
          <StarIcon class="absolute rating-button-star" />
        </div>
      </div>
      <div class="absolute left-0 top-0 bottom-0 right-0">
        <div class="rating-overlay flex gap-2 sm:gap-4">
          <div
            v-for="i in amountOfRatingBlocks"
            :key="`rating-overlay-score-star${i}`"
            class="rating-overlay-star-container flex"
          >
            <div
              :class="[score >= (i - .5) && 'show', hoverScore >= (i - .5) && 'show-new-rating']"
              class="rating-button overflow-hidden"
              @mouseenter="handleHoverRating(i - .5)"
              @click="handleSetScore(i - .5)"
            >
              <StarIcon class="rating-button-star" />
            </div>
            <div
              class="rating-button overflow-hidden"
              :class="[score >= i && 'show', hoverScore >= i && 'show-new-rating']"
              @mouseenter="handleHoverRating(i)"
              @click="handleSetScore(i)"
            >
              <StarIcon class="rating-button-star" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-2 increment-buttons">
      <div
        class="increment-button lg:hidden flex items-center justify-center"
        @click="handleIncrementScore(-.5)"
      >
        <MinusIcon class="increment-button-icon mx-auto" />
      </div>
      <div
        class="increment-button flex items-center justify-center"
        @click="handleIncrementScore(+.5)"
      >
        <PlusIcon class="increment-button-icon mx-auto" />
      </div>
    </div>
  </div>
</template>

<script>
import { StarIcon } from '@heroicons/vue/solid'
import { PlusIcon, MinusIcon } from '@heroicons/vue/outline'

export default {
  name: 'RatingScore',
  components: {
    StarIcon,
    PlusIcon,
    MinusIcon
  },
  props: {
    properties: { type: Object, required: true },
    initValue: { type: Array, default: () => ([]) },
    isMobile: { type: Boolean, default: false }
  },
  emits: ['update:value'],
  data: function () {
    return {
      score: this.initValue && this.initValue[0]?.value,
      hoverScore: 0
    }
  },
  computed: {
    amountOfRatingBlocks: function () {
      return this.properties.to - this.properties.from + 1
    }
  },
  watch: {
    score: function () {
      this.$emit('update:value', [{ value: this.score }])
    }
  },
  methods: {
    handleIncrementScore: function (incrementedValue) {
      let newScore = this.score + incrementedValue
      if (newScore < this.properties.from) {
        newScore = this.properties.from
      }
      if (newScore > this.properties.to) {
        newScore = this.properties.to
      }
      this.score = newScore
    },
    handleSetScore: function (newScore) {
      this.score = newScore
    },
    handleHoverRating: function (i) {
      this.hoverScore = i
    }
  }
}
</script>

<style scoped>
.increment-button, .rating-button {
    background-color: #F2F2F2;
    border-radius: 8px;
    width: 20%;
    cursor: pointer;
    user-select: none;
}
.rating-button:after, .increment-button:after {
    content: "";
    display: block;
    padding-bottom: 100%;
}
.increment-button {
    width: 50%;
    height: 12vw;
    position: relative;
}
.rating-button-star {
    fill: #CCCCCC;
    height: 80%;
    top: 10%;
    left: 10%;
}
.rating-overlay .rating-button {
    background-color: #FFE3AA;
    border-radius: 8px 0 0 8px;
    width: 50%;
    opacity: 0;
    transition: all .3s;
}
.rating-overlay-star-container {
    width: 20%;
    display: flex;
}
.rating-overlay .rating-button:nth-child(2n) {
    transform: scaleX(-1)
}
.rating-overlay .rating-button-star {
    fill: #F2A70D;
    position: relative;
    left: 20%;
}
.rating-overlay:not(:hover) .rating-button.show {
    opacity: 1;
}
.rating-overlay:hover .rating-button.show-new-rating {
    opacity: 1;
}
.increment-button-icon {
    height: 50%;
    position: absolute;
}
/* With Set Width */
.question.width-mobile {
    flex-direction: column;
}
.question.width-mobile .increment-button {
    display: none;
}
.question.width-mobile .increment-buttons {
    width: 100%;
}
.question.width-mobile .increment-buttons .increment-button {
    height: 6vh;
    display: flex;
}
.question.width-mobile .sm\:gap-4{
    gap:.5rem
}
@media (min-width: 1024px) {
    .question:not(.width-mobile) .increment-buttons {
        width: 11.8%;
    }

    .question:not(.width-mobile) .increment-buttons .increment-button {
        width: 100%;
    }
    .question:not(.width-mobile) .increment-button-icon {
        width: 35%;
    }

    .question:not(.width-mobile) .increment-button {
        max-width: 100%;
        width: 11.8%;
        height: auto;
    }
    .question:not(.width-mobile) .stars-block {
        width: 70%;
    }
}
@media (min-width: 1566px) {
    .question:not(.width-mobile) .increment-button, .question:not(.width-mobile) .increment-buttons {
        width: 12.1%;
    }
}

@media (min-width: 1920px) {
    .question:not(.width-mobile) .increment-button, .question:not(.width-mobile) .increment-buttons {
        width: 12.8%;
    }
}
</style>
