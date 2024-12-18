import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/*/.blade.php',
        './storage/framework/views/*.php',
        './resources/views/*/.blade.php',
        "./resources/css/*/.css",
        "./resources/js/*/.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                lily: ['Lily Script One', 'cursive'],
                alfa: ['"Alfa Slab One"', 'cursive'],
                charm: ['"Charm"', 'sans-serif'],
                crimson: ['"Crimson Text"', 'serif'],
                amatic: ['"Amatic SC"', 'cursive'],
                interTight: ['Inter Tight', 'sans-serif'],
                fraunces: ['"Fraunces"', 'serif'],
                montserrat: ['"Montserrat"', 'sans-serif'],
            },
            colors: {
                customBeige: '#FFF5E7',
                customTuquesa: '24E6CC',
                customMostaza: 'FFD79E',
                customNaranja: 'FF9D00',
            },
        },
    },

    plugins: [forms, typography],
};