export const useAuthStore = defineStore(
	'authStore',
	() => {
		const authService = useAuthService()

		const registeredDonor = ref(null)
		const authUser = ref(null)
		const authUserToken = ref(null)
		const authUserRole = ref(null)
		const hasAuthUser = ref(false)

		const login = async (payload) => {
			let response = null
			try {
				const {
					data: {
						status,
						data: { user, token }
					}
				} = await authService.login(payload)
				if (+status.code === 200) {
					authUser.value = user
					authUserToken.value = token
					authUserRole.value = user.role
					hasAuthUser.value = true
					response = user
				}
			} catch (error) {
				console.error('Login failed:', error)
			}
			return response
		}

		const register = async (payload) => {
			let response = null
			try {
				const {
					data: { status, data: user }
				} = await authService.register(payload)
				if (+status.code === 201) {
					response = user
				}
			} catch (error) {
				console.error('Registration failed:', error)
			}
			return response
		}

		const logout = async () => {
			let response = null
			try {
				const {
					data: { status, data }
				} = await authService.logout()
				if (+status.code === 200) {
					await reset()
					await navigateTo('/auth/login')
				}
				response = data
			} catch (error) {
				console.error('Logout failed:', error)
			}
			return response
		}

		const reset = async () => {
			authUser.value = false
			authUserToken.value = false
			authUserRole.value = false
			hasAuthUser.value = false
		}

		return {
			registeredDonor,
			authUser,
			authUserToken,
			authUserRole,
			hasAuthUser,
			login,
			logout,
			reset,
			register
		}
	},
	{
		persist: {
			key: 'auth',
			storage: piniaPluginPersistedstate.cookies(),
			pick: ['authUser', 'authUserToken', 'authUserRole', 'hasAuthUser']
		}
	}
)
