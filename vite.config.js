import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                    'resources/css/app.css',
                    'resources/scss/styles.scss',
                    'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "resources/scss/variables";`, 
            },
        },
    },
    build: {
        outDir: 'public/css', // 出力ディレクトリの指定
        rollupOptions: {
            input: './resources/scss/styles.scss',
        }
    }
});
