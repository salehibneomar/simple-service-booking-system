div
<script setup>
	definePageMeta({
		name: 'services',
		title: 'Services',
		requireAuth: true,
		roles: ['customer']
	})

	useHead({
		title: 'Services'
	})

	const servicesStore = useServiceStore()
	const bookingStore = useBookingStore()

	const fetching = ref(true)
	const pagingData = ref({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 12,
		from: 0
	})

	onMounted(async () => {
		await getAllServices()
	})

	const syncPagingData = (response) => {
		if (!response) return
		const { current_page, per_page, last_page, from, to, total } = response
		pagingData.value = {
			...pagingData.value,
			current_page,
			per_page,
			last_page,
			from,
			to,
			total
		}
	}

	const getAllServices = async (query = {}) => {
		fetching.value = true
		const response = await servicesStore.getAll({
			...pagingData.value,
			...query
		})
		syncPagingData(response)
		fetching.value = false
	}

	const onPageChange = async (page) => {
		pagingData.value.page = page
		await getAllServices({ page })
	}

	const datePopupOpened = ref(false)
	const serviceToBook = ref({})
	const serviceBookingDate = ref(null)
	const openDatePopup = (service) => {
		serviceToBook.value = service
		datePopupOpened.value = true
	}

	const restrictPastDateSelection = (date) => {
		const today = new Date()
		const option = new Date(date)
		return option >= today
	}

	const submitting = ref(false)
	const handleServiceBook = async () => {
		submitting.value = true
		if (serviceBookingDate.value) {
			const payload = {
				service_id: serviceToBook.value.id,
				booking_date: serviceBookingDate.value
			}
			await bookingStore.book(payload)
			serviceBookingDate.value = null
			serviceToBook.value = {}
			datePopupOpened.value = false
		}
		submitting.value = false
	}
</script>

<template>
	<q-page padding>
		<div class="row justify-start items-center q-mb-lg">
			<div />
			<q-chip
				v-if="!fetching && pagingData.total > 0"
				color="primary"
				text-color="white"
				icon="category"
				outline
			>
				{{ pagingData.total }} Available Services
			</q-chip>
		</div>

		<div v-if="fetching" class="row justify-center q-mt-xl">
			<LoadingAnimation v-model="fetching" text="Loading services..." />
		</div>

		<div
			v-else-if="servicesStore.services?.length > 0"
			class="row q-col-gutter-lg q-row-gutter-lg jutify-center"
		>
			<div
				v-for="service in servicesStore.services"
				:key="service?.id"
				class="col-12 col-sm-6 col-md-3 col-lg-3 row justify-center"
			>
				<ServiceCard class="col-12" :service="service" @on-service-book="openDatePopup" />
			</div>
		</div>

		<div v-else class="row justify-center q-mt-xl">
			<div class="col-auto text-center">
				<q-icon name="search_off" size="40px" color="grey-5" class="q-mb-sm" />
				<div class="text-caption text-grey-6">No services available</div>
			</div>
		</div>

		<div v-if="pagingData?.to > 1" class="row justify-center q-mt-lg q-pt-xs">
			<q-pagination
				v-model="pagingData.current_page"
				:max="pagingData.last_page"
				max-pages="5"
				direction-links
				flat
				boundary-links
				unelevated
				outlined
				outline
				color="blue-2"
				text-color="primary"
				active-design="unelevated"
				@update:model-value="onPageChange"
			/>
		</div>

		<q-dialog v-model="datePopupOpened" persistent>
			<q-card flat class="q-pa-none" style="width: 400px">
				<q-card-section class="q-pa-none q-mb-none">
					<q-date
						v-model="serviceBookingDate"
						flat
						today-btn
						no-unset
						mask="YYYY-MM-DD"
						class="full-width q-mb-none q-pb-none"
						:options="restrictPastDateSelection"
					/>
				</q-card-section>
				<q-card-section class="q-mt-none" style="margin-top: -35px">
					<p class="text-grey-7 text-caption text-center">
						Please select a date to book the service
					</p>
				</q-card-section>
				<q-card-actions align="right">
					<q-btn v-close-popup flat label="Close" color="grey" @click="serviceBookingDate = null" />
					<q-btn
						flat
						label="Save"
						color="primary"
						:disable="!serviceBookingDate || submitting"
						@click="handleServiceBook"
					/>
				</q-card-actions>
			</q-card>
		</q-dialog>
	</q-page>
</template>
