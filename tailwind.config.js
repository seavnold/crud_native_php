/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./clients/**/*.php",
    "./index.php"
  ],
  theme: {
    extend: {
      height: {
        '19/20': '90%'
      },
      width: {
        '1/20': '5%',
        '3/20': '15%'
      }
    },
  },
  plugins: [],
}
