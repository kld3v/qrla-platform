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
}

export const sidebarItem: menu[] = [
	{
		header: ' ',
		id: 1,
		children: [
			{
				title: 'Home',
				icon: 'home-line-duotone',
				to: '/venues',
			},
		],
	},
	{
		header: 'QRLA v.2 Features',
		id: 1,
		children: [
			{
				title: 'Seat Activity',
				icon: 'calendar-mark-line-duotone',
				to: '/apps/calendar',
				disabled: true,
			},
			{
				title: 'Calendar',
				icon: 'airbuds-case-minimalistic-line-duotone',
				to: '/apps/kanban',
				disabled: true,
			},
			{
				title: 'Event Day Data',
				icon: 'chat-round-line-line-duotone',
				to: '/apps/chats',
				disabled: true,
			},
			{
				title: 'Taskboard',
				icon: 'document-text-line-duotone',
				to: '/apps/notes',
				disabled: true,
			},
		],
	},
]

export const sidebarItemsVenue: menu[] = [
	{
		header: ' ',
		id: 1,
		children: [
			{
				title: 'Venue Home',
				icon: 'home-line-duotone',
				to: '/venues',
			},
			{
				title: 'Plaque Management Dashboard',
				icon: 'home-line-duotone',
				to: '/venues',
			},
			{
				title: 'Venue Performance Tracker',
				icon: 'home-line-duotone',
				to: '/venues',
			},
			{
				title: 'Block Performance Tracker',
				icon: 'home-line-duotone',
				to: '/venues',
			},
		],
	},
	{
		header: 'QRLA v.2 Features',
		id: 1,
		children: [
			{
				title: 'Seat Activity',
				icon: 'calendar-mark-line-duotone',
				to: '/apps/calendar',
				disabled: true,
			},
			{
				title: 'Calendar',
				icon: 'airbuds-case-minimalistic-line-duotone',
				to: '/apps/kanban',
				disabled: true,
			},
			{
				title: 'Event Day Data',
				icon: 'chat-round-line-line-duotone',
				to: '/apps/chats',
				disabled: true,
			},
			{
				title: 'Taskboard',
				icon: 'document-text-line-duotone',
				to: '/apps/notes',
				disabled: true,
			},
		],
	},
]
