const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.rose,
                primary: {
                    50: '#f0faff',
                    100: '#e0f4fe',
                    200: '#bae6fd',
                    300: '#7dd1fc',
                    400: '#38b7f8',
                    500: '#0e9fe9',
                    600: '#0284c7',
                    700: '#036ba1',
                    800: '#075a85',
                    900: '#0c4d6e',
                },
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
