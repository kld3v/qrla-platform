import { AssignBaseUrlData } from '@/types'
import axios from 'axios'

export async function assignBaseUrl(venueId: number, data: AssignBaseUrlData) {
	try {
		const response = await axios.post(`/venues/${venueId}/blocks/assign-url`, data)

		console.log('Success:', response.data)
		return response.data
	} catch (error) {
		if (axios.isAxiosError(error)) {
			console.error('Error:', error.response?.data)
		} else {
			console.error('An unexpected error occurred:', error)
		}
		throw error
	}
}
