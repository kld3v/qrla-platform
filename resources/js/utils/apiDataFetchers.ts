import axios from 'axios'
type IdType = 'venue' | 'block'

export const getAccessesByOs = async (idType: IdType, id: number): Promise<any> => {
	let params: any = {}
	switch (idType) {
		case 'venue':
			params.venueId = id
			break
		case 'block':
			params.blockId = id

		default:
			break
	}
	const res = await axios.get('/stats/accesses-by-os-browser', params)

	return res
}
