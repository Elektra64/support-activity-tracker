import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],

    safelist: [
        {
            pattern: /bg-(red|green|blue|yellow|purple|pink|lime)-(100|200|300|400|500|600|700|800|900)/,
        },
        {
            pattern: /text-(red|green|blue|yellow|purple|pink|lime)-(100|200|300|400|500|600|700|800|900)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
