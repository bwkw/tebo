/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['features/**/*.tsx', 'pages/**/*.tsx', 'components/**/*.tsx'],
  theme: {
    extend: {
      colors: {
        // 'カラー名': 'カラーコード'
        navy: '#151321',
      },
    },
  },
  plugins: [],
}
