import axios from 'axios'

const showSuccessToastFor = {
	POST: true,
	PUT: true,
	PATCH: true,
	DELETE: true
}

const toaster = async (type, message) => {
	if (typeof window !== 'undefined') {
		const { Notify } = await import('quasar')
		Notify.create({ type, message })
	}
}

function createHttpClient(baseURL, showToast = true) {
	const instance = axios.create({
		baseURL,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		}
	})

	instance.interceptors.request.use((config) => {
		try {
			const authStore = useAuthStore()
			if (authStore.hasAuthUser && authStore.authUserToken) {
				config.headers.Authorization = `Bearer ${authStore.authUserToken}`
			}

			// Handle FormData properly in browser
			if (config.data instanceof FormData) {
				// Remove Content-Type to let browser set it with boundary
				delete config.headers['Content-Type']
			}
		} catch (e) {
			console.error('Error setting Authorization header:', e)
		}
		return config
	})

	instance.interceptors.response.use(
		(response) => {
			const HTTP_METHOD = response.config.method?.toUpperCase() ?? ''
			if (showSuccessToastFor[HTTP_METHOD]) {
				const message = response.data?.status?.message ?? 'Request successful!'
				showToast && toaster('positive', message)
			}
			return response
		},
		async (error) => {
			const errorResponse = await error.response
			const errorData = errorResponse?.data || {}
			let message = errorData?.statusMessage || 'An error occurred!'

			if (errorData?.status?.message) {
				message = errorData.status.message
				try {
					const messageData = JSON.parse(message)
					if (typeof messageData === 'object') {
						message = Object.values(messageData).join(', ')
					}
				} catch (e) {
					console.error('Error parsing message:', e)
				}
			} else if (error.code === 'ERR_NETWORK') {
				message = 'Network error!'
			}

			showToast && toaster('negative', message)

			if (+errorResponse?.status === 401) {
				const authStore = useAuthStore()
				await authStore.reset()
				navigateTo('/auth/login')
			}

			return Promise.reject(error)
		}
	)

	return instance
}

let axiosInstance = null

export function httpClient() {
	if (axiosInstance) return axiosInstance

	const baseURL = import.meta.env.VITE_API_BASE_URL

	axiosInstance = createHttpClient(baseURL)
	return axiosInstance
}
