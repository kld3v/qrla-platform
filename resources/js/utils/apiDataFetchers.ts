import axios from 'axios'
import dayjs from 'dayjs'
import utc from 'dayjs/plugin/utc'

dayjs.extend(utc)

type IdType = 'venue' | 'block'

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
