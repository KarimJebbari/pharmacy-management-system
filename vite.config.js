import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'], // ملف Vue الأساسي
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // اختصار المسارات
        },
    },
    server: {
        host: 'localhost',
        port: 5173,
        proxy: {
            '/app': 'http://localhost:8000',  // تأكد أن Laravel يعمل على هذا المنفذ
        },
    },
    build: {
        outDir: 'public/build',
    },
});
