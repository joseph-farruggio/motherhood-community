const _ = require("lodash");
const theme = require("./theme.json");
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");

module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./resources/css/*.css",
    "./resources/js/*.js",
    "./safelist.txt",
  ],
  theme: {
    container: {
      padding: {
        DEFAULT: "1rem",
        sm: "2rem",
        lg: "0rem",
      },
    },
    extend: {
      colors: tailpress.colorMapper(
        tailpress.theme("settings.color.palette", theme)
      ),
      fontSize: tailpress.fontSizeMapper(
        tailpress.theme("settings.typography.fontSizes", theme)
      ),
      fontFamily: {
        "g-book": ["GothamBook"],
        "g-bold": ["GothamBold"],
        "g-medium": ["GothamMedium"],
        "g-light": ["GothamLight"],
        "cg-medium": ["CormorantGaramondMedium"],
        "avenir": ["Avenir"],
      },
    },
    screens: {
      xs: "480px",
      sm: "640px",
      md: "768px",
      lg: tailpress.theme("settings.layout.contentSize", theme),
      xlg: "1024px",
      xl: tailpress.theme("settings.layout.wideSize", theme),
      "2xl": "1440px",
    },
  },
  plugins: [tailpress.tailwind],
};
