export const useAuthService = () => {
	const client = useHttpClient()

	const login = async (payload) => {
		return await client.post(`/login`, payload)
	}

	const register = async (payload) => {
		return await client.post(`/register`, payload)
	}

	const logout = async () => {
		return await client.post(`/logout`)
	}

	return {
		login,
		logout,
		register
	}
}
