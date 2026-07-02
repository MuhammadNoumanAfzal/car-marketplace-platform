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
        asphalt: "#050816",
        graphite: "#0D1630",
        ember: "#D8A24C",
        chrome: "#E9EEF8",
        mist: "#91A0BE",
      },
      fontFamily: {
        display: ["Sora", "sans-serif"],
        body: ["Inter", "sans-serif"],
      },
      boxShadow: {
        glow: "0 20px 60px rgba(216, 162, 76, 0.22)",
      },
      backgroundImage: {
        "hero-grid":
          "radial-gradient(circle at top, rgba(216,162,76,0.18), transparent 30%), linear-gradient(135deg, rgba(255,255,255,0.06) 1px, transparent 1px)",
      },
    },
  },
  plugins: [],
};
