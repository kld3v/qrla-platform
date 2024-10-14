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
	accesses: number
	plaques: number
	access_rate: number
}
