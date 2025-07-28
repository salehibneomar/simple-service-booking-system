<script setup>
	definePageMeta({
		name: 'my-bookings',
		title: 'My Bookings',
		requireAuth: true,
		roles: ['customer']
	})

	useHead({
		title: 'My Bookings'
	})

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
		await getAllBookings()
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

	const getAllBookings = async (query = {}) => {
		fetching.value = true
		const response = await bookingStore.customerBookings({
			...pagingData.value,
			...query
		})
		syncPagingData(response)
		fetching.value = false
	}

	const onPageChange = async (page) => {
		pagingData.value.page = page
		await getAllBookings({ page })
	}
</script>

<template>
	<q-page padding>
		<div class="row justify-start items-center q-mb-lg">
			<q-chip color="primary" text-color="white" icon="event_note" outline>
				{{ pagingData?.total || 0 }} Bookings
			</q-chip>
		</div>

		<div v-if="fetching" class="row justify-center q-mt-xl">
			<LoadingAnimation v-model="fetching" text="Loading bookings..." />
		</div>

		<div v-else-if="bookingStore.bookings?.length > 0" class="q-mb-lg">
			<q-list separator>
				<BookingItem
					v-for="booking in bookingStore.bookings"
					:key="booking?.id"
					:booking-item="booking"
				/>
			</q-list>
		</div>

		<div v-else class="row justify-center q-mt-xl">
			<div class="col-auto text-center">
				<q-icon name="event_busy" size="40px" color="grey-5" class="q-mb-sm" />
				<div class="text-caption text-grey-6">No bookings found</div>
			</div>
		</div>

		<div v-if="pagingData?.last_page > 1" class="row justify-center q-mt-lg q-pt-xs">
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
	</q-page>
</template>

<style lang=""></style>
