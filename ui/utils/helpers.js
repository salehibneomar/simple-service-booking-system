export function isValidEmail(email) {
	return /^[\w.!#$%&'*+/=?^_`{|}~-]+@[\w-]+(\.[\w-]+)+$/.test(email)
}

export const utcToLocalDateTime = (utcString, options, locale = 'en-US') => {
	if (!utcString) return null
	const date = new Date(utcString)
	return date.toLocaleString(locale, options)
}

export const hasRoleMatch = (allowedRoles, role) => {
	return allowedRoles.includes(role)
}
