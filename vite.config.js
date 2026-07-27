import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/global-toast.js',
                'resources/js/product-slider.js',
                'resources/js/slider.js',
                'resources/js/standard-product.js',
                'resources/js/toast.js',
                'resources/js/cart/cart.js',
                'resources/js/cart/remove.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});