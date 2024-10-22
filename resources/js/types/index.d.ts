export interface User {
	id: number
	name: string
	email: string
	email_verified_at?: string
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

export type BlocksForBlockStatsPage = {
	id: number
	access_rate: string
	base_url_id: number
	created_at: string
	plaques: number
	name: string
	stand_id: 1
	code: string
	circleColor: string
	stats: {
		total_block_visits: number
		total_seat_visits: number
		total_visits: number
	}
}

export type BlockEverywhereElse = {
	id: number
	name: string
	stand_id: 1
}

export type Stand = {
	blocks: Block[]
	id: number
	name: string
	venue_id: number
}

export type IdType = 'venue' | 'block'
export type TimeRange = '1d' | '1w' | '1m' | '3m' | '1y'
