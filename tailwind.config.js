import defaultTheme from 'tailwindcss/defaultTheme';

const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/vue-tailwind-datepicker/**/*.js",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      backgroundImage: {
        'login-img': "url('/images/login-bg.png')",
        'register-img': "url('/images/register-bg.png')",
      },
      colors: {
        primary: '#013EA6',
        'primary-600': '#002f7f',
        secondary: '#1284A3',
        'secondary-600': '#0F6B8B',
        accent: '#001F54',
        // "vtd-primary": colors.sky, // Light mode Datepicker color
        // "vtd-secondary": colors.gray, // Dark mode Datepicker color
      },
      borderRadius: {
        'xl': '15px',
        '2xl': '20px'
      }
    },
  },

  plugins: [],
};
