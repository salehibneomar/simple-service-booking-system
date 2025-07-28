<script setup>
	definePageMeta({
		name: 'admin-dashboard',
		title: 'Dashboard',
		requireAuth: true,
		roles: ['admin']
	})

	useHead({
		title: 'Dashboard | Admin'
	})

	const authStore = useAuthStore()
</script>

<template>
	<q-page padding>
		<div class="row justify-center items-center">
			<div class="col-12">
				<q-card class="q-pa-xl shadow-2 q-mt-lg">
					<q-card-section class="row items-center q-gutter-md">
						<q-avatar size="64px" color="primary" text-color="white" icon="person" />
						<div>
							<div class="text-h6 text-weight-bold">Welcome back,</div>
							<div class="text-h5 text-primary text-weight-bold q-mt-xs">
								{{ authStore.authUser?.name }}!
							</div>
						</div>
					</q-card-section>
					<q-separator />
					<q-card-section>
						<p class="text-grey-7 q-mb-none">
							We're glad to see you. Use the menu to get started with your bookings or manage your
							services.
						</p>
					</q-card-section>
				</q-card>
			</div>
		</div>
	</q-page>
</template>

<style lang=""></style>
