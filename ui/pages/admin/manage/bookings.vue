<script setup>
	import { bookingStatus } from '~/utils/status'

	definePageMeta({
		name: 'manage-bookings',
		title: 'Manage Bookings',
		requireAuth: true,
		roles: ['admin']
	})

	useHead({
		title: 'Manage Bookings'
	})

	const bookingStore = useBookingStore()

	const columns = [
		{ name: 'id', label: 'ID', field: 'id', align: 'left' },
		{ name: 'service_name', label: 'Service Name', field: 'service_name', align: 'left' },
		{ name: 'customer_name', label: 'Customer Name', field: 'customer_name', align: 'left' },
		{ name: 'booking_date', label: 'Booking Date', field: 'booking_date', align: 'left' },
		{ name: 'status', label: 'Status', field: 'status', align: 'center' }
	]

	const fetching = ref(true)

	onMounted(async () => {
		await getAllBookings()
		fetching.value = false
	})

	const pagingData = ref({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 10,
		from: 0,
		page: 1,
		rowsPerPage: 10,
		rowsNumber: 0
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
			total,
			page: current_page,
			rowsNumber: total,
			rowsPerPage: per_page
		}
	}

	const getAllBookings = async (query = {}) => {
		const response = await bookingStore.getAll({
			...pagingData.value,
			...query
		})
		syncPagingData(response)
	}

	const onTableRequest = async (props) => {
		const { page, rowsPerPage } = props.pagination
		const query = { per_page: rowsPerPage, page }
		await getAllBookings(query)
	}

	const formatBookingDate = (dateString) => {
		if (!dateString) return 'N/A'
		return utcToLocalDateTime(dateString, {
			year: 'numeric',
			month: 'short',
			day: 'numeric'
		})
	}

	const changeBookingStatus = async (row, newStatus) => {
		if (row) {
			const payload = {
				status: newStatus
			}
			await bookingStore.updateStatus(row.id, payload)
		}
	}
</script>

<template>
	<q-page padding>
		<div class="row justify-center">
			<div class="col-12">
				<q-card flat bordered class="q-pa-xl shadow-2 q-mt-lg">
					<q-card-section class="row items-center q-gutter-md q-mb-none q-pb-none">
						<q-avatar size="48px" color="primary" text-color="white" icon="event" />
						<div>
							<div class="text-h6 text-weight-bold">Manage Bookings</div>
							<div class="text-caption text-grey-7">View and manage all requested services</div>
						</div>
					</q-card-section>

					<q-card-section v-if="!fetching">
						<q-table
							:key="`${pagingData.current_page}-${pagingData.per_page}-${pagingData.total}`"
							:rows="bookingStore.bookings || []"
							:columns="columns"
							row-key="id"
							flat
							separator="horizontal"
							bordered
							class="q-mt-md"
							:rows-per-page-options="[10, 20, 50, 100]"
							server-side
							:pagination="pagingData"
							@request="onTableRequest"
						>
							<template #body="props">
								<q-tr :props="props">
									<q-td key="id" :props="props">{{ props.row?.id }}</q-td>
									<q-td key="service_name" :props="props">
										{{ props.row?.service?.name }}
									</q-td>
									<q-td key="customer_name" :props="props">
										{{ props.row?.user?.name }}
									</q-td>
									<q-td key="booking_date" :props="props">
										{{ formatBookingDate(props.row?.booking_date) }}
									</q-td>
									<q-td key="status" :props="props">
										<q-chip
											size="sm"
											class="cursor-pointer q-pr-xs"
											:label="bookingStatus[props.row?.status]?.text || 'N/A'"
											:color="bookingStatus[props.row?.status]?.color || 'grey'"
											:text-color="bookingStatus[props.row?.status]?.textColor || 'white'"
											icon-right="arrow_drop_down"
										>
											<q-menu auto-close>
												<q-list dense>
													<q-item
														v-for="(status, key) in bookingStatus"
														:key="key"
														clickable
														:active="props.row?.status == key"
														active-class="bg-blue-1 text-primary"
														@click="changeBookingStatus(props.row, key)"
													>
														<q-item-section>{{ status.text }}</q-item-section>
													</q-item>
												</q-list>
											</q-menu>
										</q-chip>
									</q-td>
								</q-tr>
							</template>
						</q-table>
					</q-card-section>
					<q-card-section>
						<loading-animation v-model="fetching" text="Fetching..." />
					</q-card-section>
				</q-card>
			</div>
		</div>
	</q-page>
</template>

<style lang=""></style>
