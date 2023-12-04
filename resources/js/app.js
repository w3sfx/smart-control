import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Home from "@/Pages/Home/Home.vue";
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const options = {
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#dc2626',
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .component('app-layout', Home)
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
