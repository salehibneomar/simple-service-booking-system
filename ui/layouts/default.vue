<script setup>
	import { drawerLinks } from '~/assets/drawer-links'

	const route = useRoute()
	const authStore = useAuthStore()

	const drawer = ref(false)

	const pageTitle = computed(() => {
		return route.meta && route.meta.title ? route.meta.title : route.name || 'Dashboard'
	})

	const userRole = computed(() => authStore.authUserRole)
	const menuItems = computed(() => {
		return drawerLinks[userRole.value] || []
	})

	const handleLogout = async () => {
		await authStore.logout()
	}
</script>

<template>
	<q-layout view="lHh Lpr lFf" class="bg-grey-2">
		<q-drawer v-model="drawer" show-if-above side="left" bordered>
			<div class="column fit">
				<q-list class="q-mt-md">
					<q-item-label header class="text-grey-8 text-weight-bold q-mb-md text-uppercase">{{
						userRole
					}}</q-item-label>
					<q-item v-for="item in menuItems" :key="item.slug" v-ripple clickable :to="item.route">
						<q-item-section avatar>
							<q-icon :name="item.icon" />
						</q-item-section>
						<q-item-section>{{ item.label }}</q-item-section>
					</q-item>
				</q-list>
				<q-space />
				<q-separator class="q-my-none" />
				<q-list>
					<q-item v-ripple clickable @click="handleLogout">
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
