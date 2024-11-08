const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // You can define custom colors here, if needed
                'gray-100': '#f7fafc',
                'gray-200': '#edf2f7',
                'gray-500': '#a0aec0',
                'gray-600': '#718096',
                'gray-700': '#4a5568',
                'gray-800': '#2d3748',
              },
              fontFamily: {
                // Example of custom fonts if needed
                sans: ['Inter', 'Arial', 'sans-serif'],
              },
              spacing: {
                // Custom spacing if needed
                '7xl': '80rem',
              },
              screens: {
                // You can modify breakpoints as per your design
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
              },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
