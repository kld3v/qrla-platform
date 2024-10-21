import { NavOptions } from '@/types'

export interface menu {
	header?: string
	title?: string
	icon?: any
	id?: number
	to?: string
	chip?: string
	BgColor?: string
	chipBgColor?: string
	chipColor?: string
	chipVariant?: string
	chipIcon?: string
	children?: menu[]
	disabled?: boolean
	type?: string
	subCaption?: string
	nav?: NavOptions
}

export const sidebarItem: menu[] = [
	{
		header: '',
		id: 1,
		children: [
			{
				title: 'Home',
				icon: 'solar:home-line-duotone',
				to: '/venues',
				nav: 'home',
			},
			{
				title: 'Account',
				icon: 'iconoir:profile-circle',
				to: '/venues',
				nav: 'account',
			},
		],
	},
	{
		header: 'QRLA v.2 Features',
		id: 1,
		children: [
			{
				title: 'Seat Activity',
				icon: 'mdi:person-check-outline',
				to: '/apps/calendar',
				disabled: true,
			},
			{
				title: 'Calendar',
				icon: 'mdi:calendar-blank-outline',
				to: '/apps/kanban',
				disabled: true,
			},
			{
				title: 'Event Day Data',
				icon: 'mynaui:ticket',
				to: '/apps/chats',
				disabled: true,
			},
			{
				title: 'Taskboard',
				icon: 'charm:circle-tick',
				to: '/apps/notes',
				disabled: true,
			},
		],
	},
]
