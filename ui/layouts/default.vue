<script setup>
	const route = useRoute()
	const authStore = useAuthStore()

	const drawer = ref(false)

	const pageTitle = computed(() => {
		return route.meta && route.meta.title ? route.meta.title : route.name || 'Dashboard'
	})

	const handleLogout = async () => {
		await authStore.logout()
	}
</script>

<template>
	<q-layout view="lHh Lpr lFf">
		<q-drawer v-model="drawer" show-if-above side="left" bordered>
			<div class="column fit">
				<q-list class="q-mt-md">
					<q-item-label header class="text-grey-8 text-weight-bold q-mb-md">Menu</q-item-label>
					<q-item v-ripple clickable>
						<q-item-section avatar>
							<q-icon name="dashboard" />
						</q-item-section>
						<q-item-section>Dashboard</q-item-section>
					</q-item>
					<!-- Add more navigation items here -->
				</q-list>
				<q-space />
				<q-separator class="q-my-none" />
				<q-list>
					<q-item v-ripple clickable class="text-negative" @click="handleLogout">
						<q-item-section avatar>
							<q-icon name="logout" />
						</q-item-section>
						<q-item-section>Logout</q-item-section>
					</q-item>
				</q-list>
			</div>
		</q-drawer>

		<q-header elevated>
			<q-toolbar>
				<q-btn class="q-mr-sm" flat dense round icon="menu" @click="drawer = !drawer" />
				<q-toolbar-title>{{ pageTitle }}</q-toolbar-title>
			</q-toolbar>
		</q-header>

		<q-page-container>
			<slot />
		</q-page-container>
	</q-layout>
</template>
