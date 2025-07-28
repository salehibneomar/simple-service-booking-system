export const useBookingService = () => {
	const client = useHttpClient()
	const TARGET = 'bookings'

	const customerBookings = async (query = {}) => {
		return await client.get(`/${TARGET}`, {
			params: query
		})
	}

	const getAll = async (query = {}) => {
		return await client.get(`/admin/${TARGET}`, {
			params: query
		})
	}

	const book = async (payload) => {
		return await client.post(`/${TARGET}`, payload)
	}

	const updateStatus = async (id, payload) => {
		return await client.put(`/admin/${TARGET}/${id}`, payload)
	}

	return {
		book,
		customerBookings,
		getAll,
		updateStatus
	}
}
