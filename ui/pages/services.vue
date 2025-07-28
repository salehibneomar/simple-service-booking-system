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
</script>

<template>
	<q-page padding>
		<div class="row justify-start items-center q-mb-lg">
			<div />
			<q-chip
				v-if="!fetching && pagingData.total > 0"
				color="positive"
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
				<ServiceCard class="col-12" :service="service" />
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
	</q-page>
</template>
