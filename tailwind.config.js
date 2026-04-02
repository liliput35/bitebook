/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        aeonik: ['Aeonik', 'sans-serif'],
      }, 
      colors: {
        'background': '#fffefa', 
        'dark-green': '#656e51', 
        'light-green': '#9ba389', 
        'biteblack': '#312c2c', 
        'dark-gray': '#717171', 
        'light-gray': '#a2a2a2', 
        'text-box': '#d3d3d3', 
      },
    },
  },
  plugins: [],
}

