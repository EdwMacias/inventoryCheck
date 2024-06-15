/** @type {import('tailwindcss').Config} */
export default {
  content: [],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    theme: ["light"],
    darkTheme: "bumblebee", // name of one of the included themes for dark mode

    logs: true
  }
}

