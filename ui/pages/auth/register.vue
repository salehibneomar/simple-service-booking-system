<script setup>
	definePageMeta({
		name: 'register',
		title: 'Register',
		requireAuth: false,
		middleware: 'guest',
		layout: 'auth'
	})

	useHead({
		title: 'Register | Simple Service Booking System'
	})

	const router = useRouter()
	const authStore = useAuthStore()

	const formData = ref({
		name: '',
		email: '',
		password: '',
		password_confirmation: ''
	})

	const nameRule = (val) => !!val || 'Name is required'
	const emailRule = (val) => {
		if (!val) return 'Email is required'
		return isValidEmail(val) || 'Valid email required'
	}
	const passwordRule = (val) => !!val || 'Password is required'
	const retypePasswordRule = (val) => {
		if (!val) return 'Retype password is required'
		if (val !== formData.value.password) return 'Passwords do not match'
		return true
	}

	const handleRegister = async () => {
		const response = await authStore.register(formData.value)
		if (response) {
			await router.push({ path: '/auth/login', query: { registered: response?.email } })
		}
	}
</script>

<template>
	<q-page class="flex flex-center bg-grey-2" padding>
		<q-card class="q-pa-lg shadow-2" style="min-width: 350px; max-width: 400px; width: 100%">
			<q-card-section class="row justify-center q-mb-none">
				<q-avatar size="56px" color="primary" text-color="white" icon="person_add" />
			</q-card-section>
			<q-card-section>
				<div class="text-h5 text-center q-mb-md">Register</div>
				<q-form @submit.prevent="handleRegister">
					<q-input
						v-model="formData.name"
						filled
						label="Name"
						class="q-mb-md"
						:rules="[nameRule]"
						hide-bottom-space
						autocomplete="name"
					/>
					<q-input
						v-model="formData.email"
						filled
						label="Email"
						type="email"
						class="q-mb-md"
						:rules="[emailRule]"
						hide-bottom-space
						autocomplete="username"
					/>
					<q-input
						v-model="formData.password"
						filled
						label="Password"
						type="password"
						class="q-mb-md"
						:rules="[passwordRule]"
						hide-bottom-space
						autocomplete="new-password"
					/>
					<q-input
						v-model="formData.password_confirmation"
						filled
						label="Retype Password"
						type="password"
						class="q-mb-md"
						:rules="[retypePasswordRule]"
						hide-bottom-space
						autocomplete="new-password"
					/>
					<q-btn
						type="submit"
						label="Register"
						color="primary"
						class="full-width q-mb-md q-mt-sm"
						unelevated
					/>
				</q-form>
			</q-card-section>
			<q-separator />
			<q-card-section class="text-center">
				<span>Already have an account?</span>
				<q-btn flat label="Login" color="primary" class="q-ml-xs" to="/auth/login">
					<q-tooltip>Back to login</q-tooltip>
				</q-btn>
			</q-card-section>
		</q-card>
	</q-page>
</template>
