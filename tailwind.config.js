 /** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    fontFamily: {
      'title' : ['Space Mono', 'monospace', 'sans-serif'],
      'text' : ['FiraCode', 'monospace', 'sans-serif']
    },
    extend: {
      colors : {
        'blue' : '#2E5676',
        'blue-dark' : '#24445C',
        'yellow' : '#EBB100',
        'white' : '#F5F7FA',
        'dark' : '#2F3542',
        'gray' : '#98abb8'
      },
      backgroundColor : {
        'blue' : '#2E5676',
        'blue-dark' : '#24445C',
        'yellow' : '#EBB100',
        'white' : '#F5F7FA',
        'dark' : '#2F3542',
        'gray' : '#98abb8'
      }
    },
  },
  safelist: [
    'border-red-500',
    'bg-[#001A9E]',
    'bg-[#9E7700]',
    'bg-[#FFFFFF]',
    'lg:w-1/2',
    'col-span-2',
    'gap-5',
    'lg:w-2/3',
  ], 
  plugins: [],
}
