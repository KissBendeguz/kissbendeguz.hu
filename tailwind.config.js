/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./public/**/*.php",
        "./app/Views/**/*.php",
        "./src/**/*.js",
        "./src/**/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                slate: {
                    950: '#020617',
                },
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out forwards',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },
    plugins: [],
}