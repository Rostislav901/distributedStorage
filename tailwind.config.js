/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  theme: {
    extend: {
      boxShadow: {
        custom: '0px 5px 15px -2px rgba(0,0,0,0.75)',
        custom_2: '0px -5px 15px -2px rgba(0,0,0,0.75)',
      },
      backgroundImage: {
        'home-background': "url('/src/assets/img/home-bg.jpg')",
      },
      screens: {
        small400: '400px',
        w976: '976px',
        custom: '1400px',
      },
      colors: {
        customGreen: 'rgb(46, 125, 50)',
      },
    },
  },
  plugins: [],
};

