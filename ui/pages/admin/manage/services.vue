<script setup>
	import { ref } from 'vue'
	import { useQuasar } from 'quasar'
	import ServiceDialog from '@/components/ServiceDialog.vue'

	definePageMeta({
		name: 'manage-services',
		title: 'Manage Services',
		requireAuth: true,
		roles: ['admin']
	})

	useHead({
		title: 'Manage Services'
	})

	const $q = useQuasar()
	const servicesStore = useServiceStore()

	const columns = [
		{ name: 'id', label: 'ID', field: 'id', align: 'left' },
		{ name: 'name', label: 'Name', field: 'name', align: 'left' },
		{
			name: 'price',
			label: 'Price',
			field: 'price',
			align: 'left'
		},
		{ name: 'description', label: 'Description', field: 'description', align: 'left' },
		{ name: 'status', label: 'Status', field: 'status', align: 'center' },
		{ name: 'action', label: 'Action', field: 'action', align: 'center' }
	]

	const fetching = ref(true)
	const submitting = ref(false)

	onMounted(async () => {
		await getAllServices()
		fetching.value = false
	})

	const pagingData = ref({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 10,
		from: 0,
		rowsPerPage: 10,
		page: 1,
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
			rowsNumber: total,
			rowsPerPage: per_page,
			page: current_page
		}
	}

	const getAllServices = async (query = {}) => {
		const response = await servicesStore.getAll({
			...pagingData.value,
			...query
		})
		syncPagingData(response)
	}

	const onRequest = async (props) => {
		const { page, rowsPerPage } = props.pagination
		const query = { per_page: rowsPerPage, page }
		await getAllServices(query)
	}

	const deleteService = async (id) => {
		await servicesStore.remove(id)
	}

	const showDeleteDialog = (id) => {
		$q.dialog({
			title: 'Confirm Delete',
			message: 'Are you sure you want to delete this service?',
			cancel: true,
			persistent: true,
			ok: { label: 'Delete', color: 'negative', flat: true },
			cancelLabel: 'Cancel'
		}).onOk(async () => {
			await deleteService(id)
		})
	}

	const createServiceDialogOpen = ref(false)
	const handleServiceCreation = async (formData) => {
		submitting.value = true
		await servicesStore.create(formData)
		createServiceDialogOpen.value = false
		submitting.value = false
	}

	const updateServiceDialogOpen = ref(false)
	const serviceToUpdate = ref({})
	const onServiceEditClick = (service) => {
		updateServiceDialogOpen.value = true
		serviceToUpdate.value = { ...service, status: +service.status }
	}

	const handleServiceUpdate = async (formData) => {
		submitting.value = true
		await servicesStore.update(serviceToUpdate.value?.id, formData)
		updateServiceDialogOpen.value = false
		submitting.value = false
		serviceToUpdate.value = {}
	}
</script>

<template>
	<q-page padding>
		<div class="row justify-center">
			<div class="col-12">
				<q-card class="q-pa-xl shadow-2 q-mt-lg">
					<q-card-section class="row items-center q-gutter-md">
						<q-avatar size="48px" color="primary" text-color="white" icon="build" />
						<div>
							<div class="text-h6 text-weight-bold">Manage Services</div>
							<div class="text-caption text-grey-7">View and manage all available services</div>
						</div>
					</q-card-section>
					<q-separator />
					<q-card-section v-if="!fetching">
						<q-table
							:key="`${pagingData.current_page}-${pagingData.per_page}-${pagingData.total}`"
							:rows="servicesStore.services || []"
							:columns="columns"
							row-key="id"
							flat
							separator="horizontal"
							bordered
							class="q-mt-md"
							:rows-per-page-options="[10, 20, 50, 100]"
							server-side
							:pagination="pagingData"
							@request="onRequest"
						>
							<template #body="props">
								<q-tr :props="props">
									<q-td key="id" :props="props">{{ props.row?.id }}</q-td>
									<q-td key="name" :props="props">{{ props.row?.name }}</q-td>
									<q-td key="price" :props="props">{{
										props.row?.price !== undefined ? `${props.row?.price.toFixed(2)}` : ''
									}}</q-td>
									<q-td key="description" :props="props">
										<div class="ellipsis" style="max-width: 200px">
											{{
												props.row?.description && props.row?.description?.length
													? props.row?.description
													: 'N/A'
											}}
										</div>
									</q-td>
									<q-td key="status" :props="props">
										<q-chip
											:label="serviceStatus[props.row?.status]?.text || 'N/A'"
											:color="serviceStatus[props.row?.status]?.color || 'grey'"
											:text-color="serviceStatus[props.row?.status]?.textColor || 'white'"
											size="sm"
										/>
									</q-td>
									<q-td key="action" :props="props">
										<q-btn
											color="primary"
											icon="edit"
											size="sm"
											flat
											round
											@click="onServiceEditClick(props.row)"
										>
											<q-tooltip> Edit </q-tooltip>
										</q-btn>
										<q-btn
											color="negative"
											icon="delete"
											size="sm"
											flat
											round
											@click="showDeleteDialog(props.row?.id)"
										>
											<q-tooltip> Delete </q-tooltip>
										</q-btn>
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

		<ServiceDialog
			v-model="createServiceDialogOpen"
			:submitting="submitting"
			@on-save="handleServiceCreation"
		/>

		<ServiceDialog
			v-model="updateServiceDialogOpen"
			label="Update Service"
			operation="update"
			:submitting="submitting"
			:service-value="serviceToUpdate"
			@on-save="handleServiceUpdate"
		/>

		<q-page-sticky position="bottom-right" :offset="[50, 18]">
			<q-btn color="primary" icon="add" size="md" round @click="createServiceDialogOpen = true">
				<q-tooltip> Add a new service </q-tooltip>
			</q-btn>
		</q-page-sticky>
	</q-page>
</template>

<style lang=""></style>
