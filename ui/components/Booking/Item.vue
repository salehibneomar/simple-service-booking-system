<script setup>
	defineOptions({
		name: 'BookingItem'
	})

	defineProps({
		bookingItem: {
			type: Object,
			default: () => ({
				id: 1,
				status: '2',
				user_id: 2,
				service_id: 1,
				booking_date: '2025-07-28',
				created_at: '2025-07-27T20:31:07.000000Z',
				updated_at: '2025-07-27T20:32:55.000000Z',
				deleted_at: null,
				service: {
					id: 1,
					name: 'Premium House Cleaning'
				},
				user: {
					id: 2,
					name: 'Arturo Jacobs',
					email: 'damore.darrel94642@example.com',
					email_verified_at: '2025-07-27T20:28:21.000000Z',
					role: 'customer',
					status: '1',
					created_at: '2025-07-27T20:28:23.000000Z',
					updated_at: '2025-07-27T20:28:23.000000Z',
					deleted_at: null
				}
			})
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
				Booking #{{ bookingItem?.id }}
			</q-item-label>
			<q-item-label caption class="text-grey-7">
				Service: {{ bookingItem?.service?.name || `Service ID: ${bookingItem?.service_id}` }}
			</q-item-label>
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
