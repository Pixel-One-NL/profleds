module.exports = {
  jit: true,
  content: {
    relative: true,
    files: [
      './*.php',
      './inc/**/*.php',
      './template-parts/**/*.php',
      './safelist.txt',
      './woocommerce/**/*.php',
      './assets/scss/**/*.scss',
      './assets/css/**/*.css',
      './assets/js/**/*.js',
    ],
  },
  theme: {
    extend: {
      colors: {
        primary: '#3AB23A',
        'primary-hover': '#036c8f',
        'primary-light': '#9ad69a',
      },
    },
  },
  plugins: [],
};
