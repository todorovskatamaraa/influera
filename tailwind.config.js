/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./storage/framework/views/*.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', "Inter", "sans-serif"],
            },
            colors: {
                primary: {
                    DEFAULT: "hsl(262 83% 58%)",
                    foreground: "hsl(0 0% 98%)",
                },
                secondary: {
                    DEFAULT: "hsl(262 30% 96%)",
                    foreground: "hsl(262 83% 58%)",
                },
                background: "hsl(0 0% 98%)",
                foreground: "hsl(240 10% 3.9%)",
            },
            borderRadius: {
                lg: "0.5rem",
                xl: "0.75rem",
                "2xl": "1rem",
                "3xl": "1.5rem",
                "4xl": "2rem",
            },
        },
    },
    plugins: [],
};
