import { fileURLToPath, URL } from 'url'
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vuetify from 'vite-plugin-vuetify'

export default defineConfig({
	plugins: [
		laravel({
			input: 'resources/js/app.ts',
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
		vuetify({
			autoImport: true,
			styles: { configFile: 'resources/js/scss/variables.scss' },
		}),
	],
	resolve: {
		alias: {
			'@': fileURLToPath(new URL('./resources/js', import.meta.url)),
		},
	},
	css: {
		preprocessorOptions: {
			scss: {},
		},
	},
	optimizeDeps: {
		exclude: ['vuetify'],
		entries: ['./resources/js/**/*.vue'],
	},
})
