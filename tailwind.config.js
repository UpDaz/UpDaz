module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      'title' : ['Outfit'],
      'text' : ['Roboto']
    },
    extend: {
      colors : {
        'blue' : '#1940FF',
        'blue-dark' : '#001A9E',
        'brown' : '#9E7700',
        'orange' : '#EBB100'
      },
      backgroundColor : {
        'blue' : '#1940FF',
        'blue-dark' : '#001A9E',
        'brown' : '#9E7700',
        'orange' : '#EBB100'
      }
    },
  },
  safelist: [
    'border-red-500',
    'bg-[#001A9E]',
    'bg-[#9E7700]'
  ], 
  plugins: [],
}
