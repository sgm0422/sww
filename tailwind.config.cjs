/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
module.exports = {
  content: ["./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}"],
  theme: {
    extend: {
      fontFamily: {
        sans: [
          "Bricolage Grotesque Variable",
          "Inter Variable",
          "Inter",
          ...defaultTheme.fontFamily.sans,
        ],
      },
      colors: {
        primary: 'var(--sww-color-primary)',
        secondary: 'var(--sww-color-secondary)',
        accent: 'var(--sww-color-accent)',
        default: 'var(--sww-color-text-default)',
        muted: 'var(--sww-color-text-muted)',
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
  darkMode: 'class',
};
