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
