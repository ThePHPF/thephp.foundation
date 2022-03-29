module.exports = {
  content: ["./source/**/*.html"],
  theme: {
    extend: {
      colors: {
        'foundation': 'rgba(25, 25, 28, .3)',
        'baseblack': '#19191c',
        'fbg': 'rgba(25, 25, 28, .1)',
        'hborder': 'rgba(39, 40, 44, .2)',
      },
    },

    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      'smmax': {'max': '550px'}
    }
  },
  plugins: [
      require('tailwindcss'),
      require('autoprefixer'),
  ],
}
