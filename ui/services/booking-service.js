export const useBookingService = () => {
	const client = useHttpClient()
	const TARGET = 'bookings'

	const book = async (payload) => {
		return await client.post(`/${TARGET}`, payload)
	}

	const getBookingsByUser = async (query = {}) => {
		return query
	}

	return {
		book,
		getBookingsByUser
	}
}
