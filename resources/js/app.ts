import './bootstrap'
import '../css/app.css'
import '@/scss/style.scss'

import { createApp, h, DefineComponent } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

import vuetify from './plugins/vuetify'
import PerfectScrollbar from 'vue3-perfect-scrollbar'
import VueApexCharts from 'vue3-apexcharts'
import VueTablerIcons from 'vue-tabler-icons'
import VueScrollTo from 'vue-scrollto'
import VueEasyLightbox from 'vue-easy-lightbox'
import { createPinia } from 'pinia'
const pinia = createPinia()

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(pinia)
			.use(ZiggyVue)
			.use(vuetify)
			.use(PerfectScrollbar)
			.use(VueApexCharts)
			.use(VueTablerIcons)
			.use(VueEasyLightbox)
			.use(VueScrollTo, {
				duration: 1000,
				easing: 'ease',
			})
			.mount(el)
	},
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
	progress: {
		color: '#4B5563',
	},
})
