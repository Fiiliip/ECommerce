/** @type {import('tailwindcss').Config} */

// eslint-disable-next-line no-undef
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  content: ['./public/**/*.html', './src/**/*.{vue,js,ts}'],
  theme: {
    extend: {
      screens: {
        'xs': '500px',
        ...defaultTheme.screens,
      },
    },
  },
  plugins: [],
}

