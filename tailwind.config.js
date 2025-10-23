/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',  // إذا كان لديك ملف HTML في الجذر
    './src/**/*.{html,js,vue}',  // لتغطية ملفات HTML و Vue و JS داخل مجلد src
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
