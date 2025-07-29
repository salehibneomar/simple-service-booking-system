<script setup>
	defineOptions({
		name: 'BookingItem'
	})

	defineProps({
		bookingItem: {
			type: Object,
			default: () => ({})
		}
	})

	const formatBookingDate = (dateString) => {
		if (!dateString) return 'N/A'
		return utcToLocalDateTime(dateString, {
			year: 'numeric',
			month: 'short',
			day: 'numeric'
		})
	}
</script>

<template>
	<q-item class="rounded-borders q-mb-md bg-white q-py-md" style="border: 1px solid #e0e0e0">
		<q-item-section avatar>
			<q-avatar color="primary" text-color="white" size="md">
				<q-icon name="event_note" />
			</q-avatar>
		</q-item-section>

		<q-item-section>
			<q-item-label class="text-weight-bold text-primary">
				{{ bookingItem?.service?.name }}
			</q-item-label>
			<q-item-label caption class="text-grey-7"> Booking #ID {{ bookingItem?.id }} </q-item-label>
			<q-item-label caption class="text-grey-6 q-mt-xs">
				<q-icon name="calendar_today" size="xs" class="q-mr-xs" />
				{{ formatBookingDate(bookingItem?.booking_date) }}
			</q-item-label>
		</q-item-section>

		<q-item-section side>
			<q-chip
				:color="bookingStatus[bookingItem?.status]?.color || 'grey-2'"
				:text-color="bookingStatus[bookingItem?.status]?.textColor || 'grey-10'"
			>
				{{ bookingStatus[bookingItem?.status]?.text || 'Unknown' }}
			</q-chip>
		</q-item-section>
	</q-item>
</template>
