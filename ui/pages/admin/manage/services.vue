<script setup>
	definePageMeta({
		name: 'manage-services',
		title: 'Manage Services',
		requireAuth: true,
		roles: ['admin']
	})

	useHead({
		title: 'Manage Services'
	})

	const columns = [
		{ name: 'id', label: 'ID', field: 'id', align: 'left', sortable: true },
		{ name: 'name', label: 'Name', field: 'name', align: 'left', sortable: true },
		{ name: 'description', label: 'Description', field: 'description', align: 'left' },
		{
			name: 'price',
			label: 'Price',
			field: 'price',
			align: 'right',
			sortable: true,
			format: (val) => `$${val.toFixed(2)}`
		},
		{ name: 'status', label: 'Status', field: 'status', align: 'left', sortable: true }
	]

	const rows = [
		{
			id: 1,
			name: 'Haircut',
			description: 'Professional haircut service',
			price: 25,
			status: 'AVAILABLE'
		},
		{
			id: 2,
			name: 'Massage',
			description: 'Relaxing full body massage',
			price: 60,
			status: 'NOT_AVAILABLE'
		},
		{
			id: 3,
			name: 'Facial',
			description: 'Rejuvenating facial treatment',
			price: 40,
			status: 'AVAILABLE'
		}
	]
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
					<q-card-section>
						<q-table
							:rows="rows"
							:columns="columns"
							row-key="id"
							flat
							separator="horizontal"
							bordered
							class="q-mt-md"
						/>
					</q-card-section>
				</q-card>
			</div>
		</div>
	</q-page>
</template>

<style lang=""></style>
