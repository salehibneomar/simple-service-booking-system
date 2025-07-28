<script setup>
	defineOptions({
		name: 'ServiceCard'
	})

	const emit = defineEmits(['on-service-book'])

	const props = defineProps({
		service: {
			type: Object,
			default: () => ({})
		}
	})
	const shortDescription = computed(() => {
		if (!props.service?.description) return 'No description available.'
		return props.service?.description?.length > 100
			? props.service?.description?.slice(0, 100) + '...'
			: props.service?.description
	})

	const onServiceBook = () => {
		emit('on-service-book', props.service)
	}
</script>

<template>
	<q-card
		v-bind="$attrs"
		bordered
		flat
		class="shadow-3 column full-height full-width"
		style="border-radius: 8px"
	>
		<q-card-section class="bg-blue-grey-1 rounded-borders-top">
			<div class="text-body1 text-bold text-primary q-mb-sm">{{ service?.name }}</div>
			<q-chip
				dense
				class="text-bold q-ml-none"
				color="grey-1"
				text-color="grey-7"
				style="padding: 4px 8px; font-size: 13px"
			>
				<q-icon name="sell" />&ensp;Price: {{ +service?.price?.toFixed(2) }}
			</q-chip>
		</q-card-section>

		<q-card-section class="col">
			<div class="text-caption text-grey-6 ellipsis-2-lines">
				{{ shortDescription }}
			</div>
		</q-card-section>

		<q-card-actions align="right" class="bg-grey-1 rounded-borders-bottom">
			<q-btn
				dense
				unelevated
				no-caps
				rounded
				color="blue-1"
				text-color="blue-7"
				size="12px"
				@click="onServiceBook"
			>
				Book Now
			</q-btn>
		</q-card-actions>
	</q-card>
</template>

<style scoped></style>
