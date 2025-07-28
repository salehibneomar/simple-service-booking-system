export const useServicesService = () => {
	const client = useHttpClient()
	const TARGET = 'services'

	const getAll = async (query = {}) => {
		return await client.get(`/${TARGET}`, { params: query })
	}

	const create = async (payload) => {
		return await client.post(`/${TARGET}`, payload)
	}

	const update = async (id, payload) => {
		return await client.put(`/${TARGET}/${id}`, payload)
	}

	const remove = async (id) => {
		return await client.delete(`/${TARGET}/${id}`)
	}

	return {
		getAll,
		create,
		update,
		remove
	}
}
