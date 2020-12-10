export function	getlocaluser() {
	const userStr = localStorage.getItem('user')
	if (!userStr)
		return null
	else
		return JSON.parse(userStr)
}

export function getToken() {
	const token = localStorage.getItem('key')
	if (!token)
		return null
	else
		return JSON.parse(token)
}

export function getSpecialist() {
	const specialist = localStorage.getItem('specialist')
	if (!specialist)
		return null
	else
		return JSON.parse(specialist)
}