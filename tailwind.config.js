import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // or 'media' if you want to use the OS setting
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: {
                    '50': '#f6f6f6',
                    '100': '#e7e7e7',
                    '200': '#d1d1d1',
                    '300': '#b0b0b0',
                    '400': '#888888',
                    '500': '#6d6d6d',
                    '600': '#5d5d5d',
                    '700': '#4f4f4f',
                    '800': '#3f3f3f',
                    '900': '#282828',
                    '950': '#121212',
                },
            },
        },
        colors: {
            'malachite': {
                '50': '#effbef',
                '100': '#daffd9',
                '200': '#afe89f',
                '300': '#99e187',
                '400': '#3dec3c',
                '500': '#13d413',
                '600': '#0ac60a',
                '700': '#0b8a0b',
                '800': '#0f6c10',
                '900': '#0e5910',
                '950': '#013203',
            },
            'hunter-green': {
                '50': '#f4f6f3',
                '100': '#e6eae1',
                '200': '#ccd6c4',
                '300': '#a8b99c',
                '400': '#7e9671',
                '500': '#5e7851',
                '600': '#475f3c',
                '700': '#5d645a',
                '800': '#454d42',
                '900': '#2e372b',
                '950': '#192216',
            },
        },
    },

    plugins: [ require('flowbite/plugin'), forms, typography],
};
