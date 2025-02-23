import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        // Thay đổi import ở đây: Sử dụng dynamic import()
        import('laravel-vite-plugin').then(laravel => laravel.default({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        })),
    ],
});