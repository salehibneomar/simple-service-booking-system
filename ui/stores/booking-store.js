export const useBookingStore = defineStore('bookingStore', () => {
	const bookingService = useBookingService()

	const bookings = ref([])

	const book = async (payload) => {
		let response = null
		try {
			const {
				data: { status, data }
			} = await bookingService.book(payload)
			if (+status.code === 201) {
				response = data
				bookings.value.unshift(response)
			}
		} catch (error) {
			console.error('Booking failed:', error)
		}
		return response
	}

	const getBookingsByUser = async (query = {}) => {
		let response = null
		try {
			const {
				data: { status, data }
			} = await bookingService.getBookingsByUser(query)
			if (+status.code === 200) {
				bookings.value = data.data
				delete data.data
				response = data
			}
		} catch (error) {
			console.error('Failed to fetch bookings:', error)
		}
		return response
	}

	return {
		bookings,
		book,
		getBookingsByUser
	}
})
