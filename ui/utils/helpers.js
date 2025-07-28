export function isValidEmail(email) {
	return /^[\w.!#$%&'*+/=?^_`{|}~-]+@[\w-]+(\.[\w-]+)+$/.test(email)
}

export const objectToApiQuery = (query) => {
	const params = Object.entries(query)
		.filter((entry) => entry[1] !== undefined && entry[1] !== null && entry[1] !== '')
		.map(
			([k, v]) =>
				encodeURIComponent(k) + '=' + encodeURIComponent(typeof v === 'string' ? v : String(v))
		)
		.join('&')
	return params ? `?${params}` : ''
}

export const utcToLocalDateTime = (utcString, options, locale = 'en-US') => {
	if (!utcString) return null
	const date = new Date(utcString)
	return date.toLocaleString(locale, options)
}

export const hasRoleMatch = (allowedRoles, role) => {
	return allowedRoles.includes(role)
}
