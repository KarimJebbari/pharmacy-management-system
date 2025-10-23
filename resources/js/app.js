/**
 * أولاً، سنقوم بتحميل جميع التبعيات الخاصة بمشروع الجافا سكريبت مثل Vue والمكتبات الأخرى.
 * هذا يعتبر نقطة انطلاق رائعة لبناء تطبيقات ويب قوية باستخدام Vue و Laravel.
 */

import './bootstrap';  // استيراد bootstrap أو أي مكتبات إضافية تم تكوينها
import { createApp } from 'vue';  // استيراد Vue لإنشاء تطبيق Vue
import App from './App.vue';  // استيراد المكون الرئيسي للتطبيق
import router from './router';  // استيراد الـ router من الملف المخصص

/**
 * بعد ذلك، سنقوم بإنشاء نسخة جديدة من تطبيق Vue.
 * يمكنك تسجيل المكونات هنا بحيث تكون جاهزة للاستخدام في العرض.
 */

// إنشاء التطبيق
const app = createApp(App);

/**
 * تسجيل المكونات التي تريد استخدامها.
 * يمكن إضافة أي مكونات أخرى هنا حسب الحاجة.
 */

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);  // تسجيل المكون "ExampleComponent"

 /**
  * التسجيل التلقائي للمكونات باستخدام `import.meta.glob` (اختياري):
  * يمكن تمكين هذا الكود لتحميل وتسجيل جميع مكونات Vue في مجلد `components`.
  * هذه طريقة مريحة لإدارة المكونات في مشروعك بشكل ديناميكي.
  */
Object.entries(import.meta.glob('./components/**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * إذا كنت تستخدم Vuex (اختياري):
 * قم بإنشاء متجر Vuex لإدارة الحالة في التطبيق.
 */

// إذا كنت بحاجة إلى Vuex:
import { createStore } from 'vuex';
const store = createStore({
    state() {
        return {
            // أضف الحالة التي تريد إدارتها هنا
        };
    },
});
app.use(store);  // استخدام Vuex في التطبيق

/**
 * إذا كنت تستخدم Vue Router (اختياري):
 * قم بإعداد Vue Router لإدارة التنقل بين الصفحات.
 */

// استخدام الـ router الذي تم استيراده من الملف المخصص
app.use(router);  // استخدام Vue Router في التطبيق

/**
 * في النهاية، سنقوم بربط التطبيق بالعنصر HTML الذي يحمل الـ id="app".
 * هذا العنصر يجب أن يكون موجودًا في قالب Blade أو في الملف HTML.
 */
app.mount('#app');  // ربط التطبيق بالعنصر #app في الصفحة
