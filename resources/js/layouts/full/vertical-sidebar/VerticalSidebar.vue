<script setup lang="ts">
import { ref, shallowRef } from 'vue'
import { useCustomizerStore } from '@/stores/customizer'
import { sidebarItem } from './sidebarItem'
import NavGroup from './NavGroup/index.vue'
import NavItem from './NavItem/index.vue'
import NavCollapse from './NavCollapse/NavCollapse.vue'
import Logo from '../logo/Logo.vue'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'
import { NavOptions } from '@/types'

const props = defineProps<{
	isGlobalHome: boolean
	venueId?: number
	nav: NavOptions
}>()

// to update with props accordingly
const sidebarItemsVenue: any[] = [
	{
		header: '',
		id: 1,
		children: [
			{
				title: 'Venue Home',
				icon: 'material-symbols:stadium-outline-rounded',
				to: `/venues/${props.venueId}`,
				nav: 'venue_home',
			},
			{
				title: 'Plaque Management Dashboard',
				icon: 'heroicons:squares-plus',
				to: `/venues/${props.venueId}/plaque-management`,
				nav: 'plaque_management',
			},
			{
				title: 'Venue Performance Tracker',
				icon: 'ph:chart-line-up',
				to: `/venues/${props.venueId}/stats`,
				nav: 'venue_performance',
			},
			{
				title: 'Block Performance Tracker',
				icon: 'material-symbols:stairs-outline',
				to: `/venues/${props.venueId}/block-stats`,
				nav: 'block_performance',
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

// MiniSidebar Icons End
const customizer = useCustomizerStore()
const sidebarMenu = shallowRef(props.isGlobalHome ? sidebarItem : sidebarItemsVenue)
</script>

<template>
	<!-- LeftSidebar Items -->
	<v-navigation-drawer
		v-model="customizer.Sidebar_drawer"
		elevation="0"
		rail-width="1"
		app
		top="0"
		class="leftSidebar"
		:rail="customizer.mini_sidebar"
		width="240">
		<!---Logo part -->
		<div class="pa-4 pb-0">
			<Logo />
		</div>

		<!-- ---------------------------------------------- -->
		<!---Navigation -->
		<!-- ---------------------------------------------- -->
		<perfect-scrollbar class="scrollnavbar">
			<div class="px-4 py-4 sidebar-menus">
				<v-list class="py-1">
					<div class="w-full px-4 flex align-center my-4">
						<v-avatar
							v-if="QCARDCOMPANYLOGO"
							size="40">
							<img
								:src="QCARDCOMPANYLOGO"
								alt="avatar"
								width="40" />
						</v-avatar>
						<p class="h3 ml-4 muted">{{ $page.props.auth.user.name }}</p>
					</div>
					<template v-for="(item, i) in sidebarMenu">
						<!---Item Sub Header -->
						<v-divider class="mt-2 mb-2"></v-divider>
						<NavGroup
							:item="item"
							v-if="item.header"
							:key="item.title" />
						<!---If Has Child -->
						<template v-for="sItem in item.children">
							<NavCollapse
								class="leftPadding"
								:item="sItem"
								:level="0"
								v-if="sItem.children" />
							<NavItem
								:item="sItem"
								:class="['leftPadding mb-2', sItem.nav === props.nav ? 'v-list-item--active' : '']"
								v-else />
						</template>
					</template>
				</v-list>
			</div>
		</perfect-scrollbar>
	</v-navigation-drawer>
</template>

<style>
.muted {
	color: rgba(var(--v-theme-muted));
}
</style>
