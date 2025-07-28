export const serviceStatus = {
	1: {
		text: 'Available',
		color: 'green-2',
		textColor: 'green-10',
		value: 1
	},
	0: {
		text: 'Not Available',
		color: 'red-2',
		textColor: 'red-10',
		value: 0
	}
}

export const serviceStatusOptions = Object.values(serviceStatus).map((status) => ({
	label: status.text,
	value: status.value
}))
