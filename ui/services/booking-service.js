export const useBookingService = () => {
	const client = useHttpClient()
	const TARGET = 'bookings'

	const book = async (payload) => {
		return await client.post(`/${TARGET}`, payload)
	}

	const customerBookings = async (query = {}) => {
		return await client.get(`/${TARGET}`, {
			params: query
		})
	}

	return {
		book,
		customerBookings
	}
}
