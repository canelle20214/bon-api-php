module.exports = {
  content: [
    './pages/**/*.{html,js,jsx}',
    './contexts/**/*.{html,js,jsx}',
    './components/**/*.{html,js,jsx}'
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/line-clamp'),
  ],
}
