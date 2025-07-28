export const useServiceStore = defineStore('serviceStore', () => {
	const servicesService = useServicesService()
	const services = ref([])
	const service = ref({})

	const getAll = async (query = {}) => {
		let response = null
		try {
			const {
				data: { status, data }
			} = await servicesService.getAll(query)
			if (+status.code === 200) {
				services.value = data.data
				delete data.data
				response = data
			}
		} catch (error) {
			console.error('Failed to fetch services:', error)
		}

		return response
	}

	const remove = async (id) => {
		let response = null
		try {
			const {
				data: { status, data }
			} = await servicesService.remove(id)
			if (+status.code === 200) {
				services.value = services.value?.filter((service) => +service.id !== +id)
				response = data
			}
		} catch (error) {
			console.error('Failed to delete service:', error)
		}

		return response
	}

	return {
		services,
		service,
		getAll,
		remove
	}
})
