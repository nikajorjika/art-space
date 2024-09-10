import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwind from 'tailwindcss'
import autoprefixer from 'autoprefixer'
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    css: {
        postcss: {
            plugins: [tailwind(), autoprefixer()],
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
