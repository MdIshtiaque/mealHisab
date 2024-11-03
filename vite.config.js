import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/sw.js'],
            refresh: true,
        }),
        VitePWA({
            strategies: 'injectManifest',
            srcDir: 'resources/js',
            filename: 'sw.js',
            registerType: 'autoUpdate',
            manifest: {
                name: 'Meal Manager',
                short_name: 'MealMgr',
                description: 'A meal management system for tracking meals and expenses',
                theme_color: '#4f46e5',
                background_color: '#ffffff',
                display: 'standalone',
                orientation: 'portrait',
                start_url: '/',
                scope: '/',
                icons: [
                    {
                        src: '/icons/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png',
                        purpose: 'any maskable'
                    },
                    {
                        src: '/icons/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'any maskable'
                    }
                ],
                categories: ['food', 'lifestyle'],
                shortcuts: [
                    {
                        name: "Daily Meal",
                        url: "/daily-meal",
                        icons: [{ src: "/icons/icon-96x96.png", sizes: "96x96" }]
                    }
                ]
            },
            workbox: {
                globPatterns: ['**/*.{js,css,html,ico,png,svg,webp}'],
                navigateFallback: null,
                cleanupOutdatedCaches: true,
            },
            devOptions: {
                enabled: true,
                type: 'module'
            }
        })
    ],
});
