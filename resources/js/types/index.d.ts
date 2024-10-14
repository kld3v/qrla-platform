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
	status: 'active' | 'inactive'
	actions: unknown
}
