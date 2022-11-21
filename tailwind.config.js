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
        primary: '#00a8e0',
        'primary-hover': '#036c8f',
      },
    },
  },
  plugins: [],
};
