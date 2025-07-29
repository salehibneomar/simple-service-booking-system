<script setup>
	const currentYear = computed(() => {
		return new Date().getFullYear()
	})
</script>

<template>
	<q-layout>
		<q-page-container class="bg-grey-2">
			<slot />
		</q-page-container>
		<q-footer class="flex flex-center q-pa-sm bg-transparent text-grey-8 text-body2">
			<span
				>&copy; {{ currentYear }} Saleh Ibne Omar &mdash;
				<a
					href="https://www.linkedin.com/in/salehibneomar"
					target="_blank"
					rel="noopener"
					class="text-primary"
					>LinkedIn</a
				>
			</span>
		</q-footer>
	</q-layout>
</template>
