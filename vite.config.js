import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/pages/home.css",
                "resources/css/pages/hunian.css",
                "resources/css/pages/business.css",
                "resources/css/pages/about.css",
                "resources/css/pages/kontak.css",
                "resources/css/pages/show.css",
                "resources/css/pages/brochure.css",
                // JS
                "resources/js/app.js",
                "resources/js/pages/home.js",
                "resources/js/pages/business.js",
                "resources/js/pages/show.js",
                "resources/js/pages/brochure.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
