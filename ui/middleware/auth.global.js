export default defineNuxtRouteMiddleware((to) => {
	const authStore = useAuthStore()
	const roles = to.meta?.roles || []
	const requiresAuth = to.meta?.requireAuth || false

	if (requiresAuth) {
		if (!authStore.hasAuthUser) {
			return navigateTo('/auth/login')
		} else if (roles?.length && !hasRoleMatch(roles, authStore.authUserRole)) {
			return navigateTo('/')
		}
	}
})
