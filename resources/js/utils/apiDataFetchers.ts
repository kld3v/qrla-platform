import { IdType, TimeRange } from '@/types'
import axios from 'axios'
import dayjs from 'dayjs'
import utc from 'dayjs/plugin/utc'

dayjs.extend(utc)

export const getAccessesByOs = async (idType: IdType, id: number): Promise<any> => {
	let params: any = {}

	const now = dayjs().utc().toISOString()
	const oneWeekAgo = dayjs().utc().subtract(7, 'days').toISOString()

	// Add the time params
	params.start_time = now
	params.end_time = oneWeekAgo

	switch (idType) {
		case 'venue':
			params.venue_id = id
			break
		case 'block':
			params.block_id = id
			break
		default:
			break
	}

	const res = await axios.get('/stats/accesses-by-os-browser', { params })

	return res
}

export const getAccessesOverTime = async (idType: IdType, id: number, timeRange: TimeRange): Promise<any> => {
	let params: any = {}

	const now = dayjs().utc().toISOString()
	let start_time: string

	// Determine the start_time based on the provided timeRange
	switch (timeRange) {
		case '1d':
			start_time = dayjs().utc().subtract(1, 'day').toISOString()
			break
		case '1w':
			start_time = dayjs().utc().subtract(7, 'days').toISOString()
			break
		case '1m':
			start_time = dayjs().utc().subtract(1, 'month').toISOString()
			break
		case '3m':
			start_time = dayjs().utc().subtract(3, 'months').toISOString()
			break
		case '1y':
			start_time = dayjs().utc().subtract(1, 'year').toISOString()
			break
		default:
			start_time = dayjs().utc().subtract(7, 'days').toISOString() // Default to one week
			break
	}

	// Add the time params
	params.start_time = start_time
	params.end_time = now

	// Add the ID based on the idType
	switch (idType) {
		case 'venue':
			params.venue_id = id
			break
		case 'block':
			params.block_id = id
			break
		default:
			break
	}

	const res = await axios.get('/stats/accesses-over-time', { params })

	return res
}

export const getAccessesByBlockOverTime = async (venueId: number, timeRange: TimeRange): Promise<any> => {
	let params: any = {}

	const now = dayjs().utc().toISOString()
	let start_time: string

	// Determine the start_time based on the provided timeRange
	switch (timeRange) {
		case '1d':
			start_time = dayjs().utc().subtract(1, 'day').toISOString()
			break
		case '1w':
			start_time = dayjs().utc().subtract(7, 'days').toISOString()
			break
		case '1m':
			start_time = dayjs().utc().subtract(1, 'month').toISOString()
			break
		case '3m':
			start_time = dayjs().utc().subtract(3, 'months').toISOString()
			break
		case '1y':
			start_time = dayjs().utc().subtract(1, 'year').toISOString()
			break
		default:
			start_time = dayjs().utc().subtract(7, 'days').toISOString() // Default to one week
			break
	}

	// Add the time params
	params.start_time = start_time
	params.end_time = now

	// Add the ID based on the idType
	params.venue_id = venueId

	const res = await axios.get('/stats/accesses-by-block', { params })

	return res
}
