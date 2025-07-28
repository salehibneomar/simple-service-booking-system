<script setup>
	import { roleRootRoutes } from '~/assets/role-root-routes'

	definePageMeta({
		name: 'login',
		title: 'Login',
		requireAuth: false,
		middleware: 'guest',
		layout: 'auth'
	})

	useHead({
		title: 'Login | Simple Service Booking System'
	})

	const router = useRouter()
	const route = useRoute()
	const authStore = useAuthStore()

	const formData = ref({
		email: 'admin@example.com',
		password: '123456'
	})

	onMounted(() => {
		const routeQuery = route.query
		if (routeQuery?.registered) {
			formData.value.email = routeQuery.registered
		}
	})

	const emailRule = (val) => {
		if (!val) return 'Email is required'
		return isValidEmail(val) || 'Valid email required'
	}

	const handleLogin = async () => {
		const response = await authStore.login(formData.value)
		if (response && authStore.hasAuthUser) {
			router.push({ path: roleRootRoutes[authStore.authUserRole] || '/' })
		}
	}
</script>

<template>
	<q-page class="flex flex-center bg-grey-2" padding>
		<q-card class="q-pa-lg shadow-2" style="min-width: 350px; max-width: 400px; width: 100%">
			<q-card-section class="row justify-center q-mb-none">
				<q-avatar size="56px" color="primary" text-color="white" icon="login" />
			</q-card-section>
			<q-card-section>
				<div class="text-h5 text-center q-mb-md">Login</div>
				<q-form @submit.prevent="handleLogin">
					<q-input
						v-model="formData.email"
						filled
						label="Email"
						type="email"
						class="q-mb-md"
						:rules="[emailRule]"
						hide-bottom-space
					/>
					<q-input
						v-model="formData.password"
						filled
						label="Password"
						type="password"
						class="q-mb-md"
						:rules="[(val) => !!val || 'Password is required']"
						hide-bottom-space
					/>
					<q-btn
						unelevated
						type="submit"
						label="Login"
						color="primary"
						class="full-width q-mb-md q-mt-sm"
					/>
				</q-form>
			</q-card-section>
			<q-separator />
			<q-card-section class="text-center">
				<span>Don't have an account?</span>
				<q-btn flat label="Register" color="primary" class="q-ml-xs" to="/auth/register">
					<q-tooltip> Register as a customer </q-tooltip>
				</q-btn>
			</q-card-section>
		</q-card>
	</q-page>
</template>
