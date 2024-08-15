/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './src/**/*.{html,js,ts,vue}', // Ajusta esta línea para que coincida con la estructura de tu proyecto
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      "emerald",
      "dracula"
    ],
    logs: true,
  },
}