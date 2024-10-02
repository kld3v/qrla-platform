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

export type QCardType = {
	title: string
	dataValue: number
	icon: string
	customIcon?: string
	bg: 'primary-gradient' | 'warning-gradient' | 'secondary-gradient' | 'error-gradient' | 'success-gradient' | 'dark-primary-gradient'
	color: 'primary' | 'warning' | 'secondary' | 'error' | 'success'
	link?: string
	linkButtonText?: string
}
