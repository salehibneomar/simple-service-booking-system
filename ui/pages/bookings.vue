<script setup>
	definePageMeta({
		name: 'my-bookings',
		title: 'My Bookings',
		requireAuth: true,
		roles: ['customer']
	})

	useHead({
		title: 'My Bookings'
	})
</script>

<template>
	<q-page padding> <booking-item /> </q-page>
</template>

<style lang=""></style>
