import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#EFF6FF',
                    100: '#DBEAFE',
                    200: '#BFDBFE',
                    300: '#93C5FD',
                    400: '#60A5FA',
                    500: '#3B82F6',  // Original primary color
                    600: '#2563EB',
                    700: '#1D4ED8', // Tu color original
                    800: '#1E40AF',
                    900: '#1E3A8A',
                    DEFAULT: '#3B82F6' // Original primary color
                },
                secondary: {
                    50: '#FFF7ED',
                    100: '#FFEDD5',
                    200: '#FED7AA',
                    300: '#FDBA74',
                    400: '#FB923C',
                    500: '#F97316',
                    600: '#EA580C',
                    700: '#C2410C',
                    800: '#9A3412',
                    900: '#7C2D12',
                    DEFAULT: '#F97316'
                },
                accent: {
                    50: '#ECFDF5',
                    100: '#D1FAE5',
                    200: '#A7F3D0',
                    300: '#6EE7B7',
                    400: '#34D399',
                    500: '#10B981',  // Original green
                    600: '#059669',
                    700: '#047857',
                    800: '#065F46',
                    900: '#064E3B',
                    DEFAULT: '#10B981'  // Original green
                },
                secondary: {
                    50: '#FCE7F3',
                    100: '#FBCFE8',
                    200: '#F9A8D4',
                    300: '#F472B6',
                    400: '#EC4899',  // Original pink
                    600: '#DB2777',
                    700: '#BE185D',
                    800: '#9D174D',
                    900: '#831843',
                    DEFAULT: '#EC4899'  // Original pink
                },
                // Colores usados en el sitio público
                masonic: {
                    blue: '#1D4ED8',     // Original blue
                    gold: '#D4AF37',     // Dorado/Masonico
                    green: '#10B981',    // Original verde
                    amber: '#F59E0B',    // Original ámbar
                    red: '#DC2626',      // Rojo
                    purple: '#7C3AED'    // Púrpura original
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
