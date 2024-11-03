import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: colors.indigo,
                secondary: colors.violet,
                accent: colors.emerald,
            }
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
