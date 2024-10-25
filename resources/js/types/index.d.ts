export interface User {
	id: number
	name: string
	email: string
	email_verified_at?: string
	profile_photo_url?: string
	role: string
	phone: string
	organisation: Organisation
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
	auth: {
		user: User
	}
}

export type QColors = 'primary' | 'warning' | 'secondary' | 'error' | 'success' | 'purple' | 'white'

export type QCardType = {
	title: string
	dataValue: number
	icon: string
	customIcon?: string
	bg: 'primary-gradient' | 'warning-gradient' | 'secondary-gradient' | 'error-gradient' | 'success-gradient' | 'dark-primary-gradient'
	color: QColors
	link?: string
	linkButtonText?: string
}

export type VenuesTableData = {
	venue: unknown
	type: string
	location: string
	status: 'Active' | 'Inactive'
	action: 'view'
	id: number
}

export type NavOptions = 'venue_home' | 'plaque_management' | 'venue_performance' | 'block_performance' | 'home' | 'account'

export type BlockExtended = {
	id: number
	access_rate: string
	base_url_id: number
	created_at: string
	plaques: number
	name: string
	stand_id: 1
	code: string
	color: string
	stats: {
		total_block_visits: number
		total_seat_visits: number
		total_visits: number
	}
}

export type BlockShort = {
	id: number
	name: string
	stand_id: 1
	access_count: number
	access_percent: number
	block_id: number
	block_name: string
}

export type Stand = {
	blocks: BlockExtended[]
	id: number
	name: string
	venue_id: number
}

export type IdType = 'venue' | 'block'
export type TimeRange = '1d' | '1w' | '1m' | '3m' | '1y'

interface AssignBaseUrlData {
	url: string
	blocks: BlockExtended['id'][] // Array of block IDs
}

export type VenuePageProps = {
	address_line1: string
	banner_url: string
	capacity: number
	city: string
	contact_email: string
	contact_phone: string
	country: string
	created_at: string
	id: number
	logo_url: string
	long_description: string
	name: string
	postcode: string
	short_description: string
	status: 'Active' | 'Inactive'
	type: string
	updated_at: Date
	organisation_id: number
	organisation: Organisation
	accesses: number
	plaques: number
	access_rate: string
	map_svg_url: string
}
export interface Organisation {
	id: number
	name: string
	address_line1: string
	city: string
	country: string
	postcode: string
	contact_email: string
	contact_phone: string
	logo_path: string
	created_at: string // You can use Date if you want to handle it as a date object
	updated_at: string // Same here, use Date if it's preferable to handle it as a Date
}

interface QPlaqueActivityGraphDataObject {
	time_group: string
	total_access_count: number
	seat_access_count: number
	block_access_count: number
}
