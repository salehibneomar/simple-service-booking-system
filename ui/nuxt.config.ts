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

	pinia: {
		storesDirs: ['stores/**']
	},

	imports: {
		dirs: ['composables', 'utils', 'types', 'services']
	},

	plugins: [],

	quasar: {
		plugins: ['Dialog', 'Loading', 'LoadingBar', 'Notify'],
		extras: {
			font: 'roboto-font'
		},
		config: {
			loadingBar: {
				color: 'white'
			},
			notify: {
				timeout: 1000,
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
