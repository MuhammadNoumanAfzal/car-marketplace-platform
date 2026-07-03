/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        asphalt: "#090909",
        graphite: "#161616",
        ember: "#e11d2e",
        chrome: "#f5f5f5",
        mist: "#a3a3a3",
      },
      fontFamily: {
        display: ["Sora", "sans-serif"],
        body: ["Inter", "sans-serif"],
      },
      boxShadow: {
        glow: "0 20px 60px rgba(225, 29, 46, 0.28)",
      },
      backgroundImage: {
        "hero-grid":
          "radial-gradient(circle at top, rgba(225,29,46,0.16), transparent 30%), linear-gradient(135deg, rgba(255,255,255,0.06) 1px, transparent 1px)",
      },
    },
  },
  plugins: [],
};
