/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily:{     
      open : '"Open Sans"',
      poppins : "'Poppins', sans-serif",
      raleway : "'Raleway', sans-serif",
    },
    extend: {},
  },
  plugins: [],
}

