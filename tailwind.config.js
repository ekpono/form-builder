const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue'
  ],

  theme: {
    extend: {
      fontSize: {
        ...defaultTheme.fontSize,
        xxs: '11px'
      },
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans]
      },
      colors: {
        cyan: colors.cyan,
        navy: '#050038',
        dsblue: '#4262FF',
        txtgray: '#808080',
        kick_off: '#EEC85E',
        follow_up: '#BFBFBF',
        typ: '#50D66A',
        multiple_choice: '#FF6475',
        time_delay: '#D9E0FF',
        buttonRed: '#D51920'
      },
      keyframes: {
        showFromOpacity: {
          '0%': { opacity: 0 },
          '100%%': { opacity: 1 }
        }
      },
      animation: {
        showFromOpacity: 'showFromOpacity 1s ease-in-out both'
      }
    }
  },

  variants: {
    extend: {
      opacity: ['disabled'],
      borderWidth: ['last'],
      border: ['last'],
      padding: ['even', 'odd']
    }
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio')
  ]
}
