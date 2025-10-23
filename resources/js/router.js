// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import PurchasePage from './components/PurchasePage.vue'; // تأكد من المسار الصحيح

const routes = [
    {
        path: '/medications/purchase',
        name: 'purchase',
        component: PurchasePage,
    },
    {
        path: '/medications',  // المسار الجديد
        name: 'medications',
        component: PurchasePage,  // أو قم بتحديد مكون آخر حسب الحاجة
    },
    // أضف مسارات أخرى إذا لزم الأمر
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;