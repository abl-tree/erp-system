import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
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
        secondary: '#1284A3',
        'secondary-600': '#0F6B8B',
        accent: '#001F54'
      },
      borderRadius: {
        'xl': '15px',
        '2xl': '20px'
      }
    },
  },

  plugins: [],
};
