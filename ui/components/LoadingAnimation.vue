<script setup>
	defineOptions({
		name: 'LoadingAnimation'
	})
	defineProps({
		text: {
			type: [String, Boolean],
			default: false
		}
	})
	const loading = defineModel({ type: Boolean, default: false })
</script>

<template>
	<div v-if="loading" class="text-center text-grey-7 q-pa-md">
		<q-spinner-dots color="primary" size="40px" />
		<p v-if="text">{{ text }}</p>
	</div>
</template>
