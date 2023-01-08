/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['features/**/*.tsx', 'pages/**/*.tsx', 'components/**/*.tsx'],
  theme: {
    extend: {
      colors: {
        navy: '#151321',
      },
    },
  },
  plugins: [],
}
