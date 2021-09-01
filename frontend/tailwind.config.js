module.exports = {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        secondary: '#4E4E50',
        danger: '#E1292A' 
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
