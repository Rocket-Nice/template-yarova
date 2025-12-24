import path from "path";

const rootFolder = path.basename(path.resolve()); // Корневая папка проекта
const buildFolder = "../assets"; // Папка с файлами на продакшн
const srcFolder = "./src"; // Папка с исходниками

export default {
  build: {
    js: `${buildFolder}/js/`,
    css: `${buildFolder}/css/`,
    html: `${buildFolder}/`,
    images: `${buildFolder}/img/`,
    convertImages: `./convert-images/`,
    resources: `${buildFolder}/fonts/`,
  },

  src: {
    js: `${srcFolder}/js/index.js`,
    scss: `${srcFolder}/scss/style.scss`,
    html: `${srcFolder}/*.html`,
    images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp}`,
    svg: `${srcFolder}/img/**/*.svg`,
    svgIcons: `${srcFolder}/icons-to-sprite/**/*.svg`,
    convertImages: `./convert-images/**/*.*`,
    resources: `${srcFolder}/fonts/**/*.*`,
  },

  watch: {
    js: `${srcFolder}/js/**/*.js`,
    scss: `${srcFolder}/scss/**/*.{scss,sass,css}`,
    html: `${srcFolder}/**/*.html`,
    images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp}`,
    convertImages: `convert-images/**/*.*`,
    svg: `${srcFolder}/img/**/*.svg`,
    resources: `${srcFolder}/fonts/**/*.*`,
  },

  clean: buildFolder,
  buildFolder,
  srcFolder,
  rootFolder,
};
