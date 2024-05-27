import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'https://fruit-store.up.railway.app/resources/sass/app.scss',
                'https://fruit-store.up.railway.app/resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: {
                app: 'https://fruit-store.up.railway.app/resources/js/app.js',
                styles: 'https://fruit-store.up.railway.app/resources/css/app.css'
            },
        },
    },
    base: process.env.APP_URL || 'https://fruit-store.up.railway.app/',
});
