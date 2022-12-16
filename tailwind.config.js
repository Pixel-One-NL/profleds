module.exports = {
  jit: true,
  content: {
    relative: true,
    files: [
      './*.php',
      './inc/**/*.php',
      './template-parts/**/*.php',
      './safelist.txt',
    ],
  },
  theme: {
    extend: {
      colors: {
        primary: '#3AB23A',
        'primary-hover': '#036c8f',
      },
    },
  },
  plugins: [],
};
