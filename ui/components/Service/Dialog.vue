<script setup>
	defineOptions({
		name: 'ServiceDialog'
	})

	const props = defineProps({
		label: {
			type: [String],
			default: 'Create Service'
		},
		serviceValue: {
			type: Object,
			default: () => ({
				name: '',
				price: '',
				description: '',
				status: 1
			})
		},
		operation: {
			type: String,
			default: 'create'
		},
		submitting: {
			type: Boolean,
			default: false
		}
	})

	const open = defineModel({ type: Boolean, default: false })
	const formData = ref({ ...props.serviceValue })

	watch(
		() => props.serviceValue,
		(val) => {
			formData.value = { ...val }
		},
		//Runs immediately on component mount
		{ deep: true, immediate: true }
	)

	watch(
		() => props.submitting,
		(val, oldVal) => {
			//This only runs when the api call is over
			if (oldVal && !val) {
				formData.value = { ...props.serviceValue }
			}
		}
	)

	const emit = defineEmits(['on-save', 'on-close'])

	const handleSave = () => {
		emit('on-save', { ...formData.value })
	}
</script>

<template>
	<q-dialog v-model="open" persistent>
		<q-card style="min-width: 350px; max-width: 90vw">
			<q-card-section class="row items-center q-gutter-md bg-primary text-white">
				<q-avatar icon="build" color="white" text-color="primary" />
				<div class="text-h6 text-weight-bold">
					{{ label }}
				</div>
			</q-card-section>
			<q-separator />
			<q-card-section>
				<q-form class="q-gutter-md" @submit.prevent="handleSave">
					<q-input
						v-model="formData.name"
						label="Service Name"
						outlined
						dense
						:rules="[(val) => !!val || 'Name is required']"
						color="primary"
						autofocus
						hide-bottom-space
					/>
					<q-input
						v-model.number="formData.price"
						label="Price"
						type="number"
						outlined
						dense
						min="0"
						step="0.1"
						color="primary"
						:rules="[(val) => !!val || 'Price is required']"
						hide-bottom-space
					/>
					<q-input
						v-model="formData.description"
						label="Description"
						outlined
						dense
						color="primary"
						autogrow
						hide-bottom-space
						input-style="min-height: 100px;"
					/>
					<q-select
						v-model="formData.status"
						:options="serviceStatusOptions"
						label="Status"
						outlined
						dense
						color="primary"
						emit-value
						map-options
						option-value="value"
						option-label="label"
						:rules="[(val) => val !== null || val !== undefined || 'Status is required']"
					/>
				</q-form>
			</q-card-section>
			<q-separator />
			<q-card-actions align="right">
				<q-btn v-close-popup flat label="Close" color="grey" />
				<q-btn flat label="Save" color="primary" :disable="submitting" @click="handleSave" />
			</q-card-actions>
		</q-card>
	</q-dialog>
</template>
