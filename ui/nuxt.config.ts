// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	compatibilityDate: '2025-07-15',
	devtools: { enabled: false },

	modules: [
		'@nuxt/eslint',
		'@nuxt/fonts',
		'@nuxt/icon',
		'@nuxt/scripts',
		'@pinia/nuxt',
		'pinia-plugin-persistedstate/nuxt',
		'nuxt-quasar-ui'
	],

	pinia: {
		storesDirs: ['stores/**']
	},

	imports: {
		dirs: ['composables', 'utils', 'types', 'services']
	},

	plugins: [],

	vite: {
		define: {
			global: 'globalThis'
		},
		resolve: {
			alias: {
				'form-data': 'form-data'
			}
		},
		optimizeDeps: {
			include: ['axios', 'form-data']
		}
	},

	nitro: {
		experimental: {
			wasm: true
		}
	},

	quasar: {
		plugins: ['Dialog', 'Loading', 'LoadingBar', 'Notify'],
		extras: {
			font: 'roboto-font'
		},
		config: {
			notify: {
				timeout: 2000,
				progress: true,
				actions: [
					{
						icon: 'close',
						color: 'white',
						round: true,
						flat: true,
						size: 'sm'
					}
				]
			}
		}
	}
})
