<script setup lang="ts">
import { ref, shallowRef } from 'vue'
import { useCustomizerStore } from '@/stores/customizer'
import { sidebarItem } from './sidebarItem'
import NavGroup from './NavGroup/index.vue'
import NavItem from './NavItem/index.vue'
import NavCollapse from './NavCollapse/NavCollapse.vue'
import Logo from '../logo/Logo.vue'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'

const props = defineProps<{
	isGlobalHome: boolean
	venueId?: number
}>()

// to update with props accordingly
const sidebarItemsVenue: any[] = [
	{
		header: '',
		id: 1,
		children: [
			{
				title: 'Venue Home',
				icon: 'home-line-duotone',
				to: `/venues/${props.venueId}`,
			},
			{
				title: 'Plaque Management Dashboard',
				icon: 'home-line-duotone',
				to: '/PlaqueManagement',
			},
			{
				title: 'Venue Performance Tracker',
				icon: 'home-line-duotone',
				to: '/VenueStats',
			},
			{
				title: 'Block Performance Tracker',
				icon: 'home-line-duotone',
				to: '/BlockStats',
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

const findTitleByPath = (items: any, path: any) => {
	let title = ''

	for (const item of items) {
		if (item.to === path) {
			title = item.id
			break
		} else if (item.children) {
			for (const child of item.children) {
				if (child.to === path) {
					title = item.id
					break
				} else if (child.children) {
					for (const grandChild of child.children) {
						if (grandChild.to === path) {
							title = item.id
							break
						}
					}
				}
			}
		}
	}

	return title
}

const foundId = findTitleByPath(sidebarItem, window.location.pathname)
const getCurrent = foundId ? foundId : 1
const currentMenu = ref<any>(getCurrent)
function showData(data: any) {
	currentMenu.value = data
	//customizer.SET_MINI_SIDEBAR(!customizer.mini_sidebar)
}

// MiniSidebar Icons End
const customizer = useCustomizerStore()
const sidebarMenu = shallowRef(props.isGlobalHome ? sidebarItem : sidebarItemsVenue)
</script>

<template>
	<!-- Minisidebar Icons -->
	<!-- <v-navigation-drawer
		class="bg-background"
		v-model="customizer.Sidebar_drawer"
		top="0"
		rail
		rail-width="80">
		<perfect-scrollbar class="miniscrollnavbar">
			<v-list-item class="px-0">
				<div
					v-if="!isHome"
					class="px-4 mb-3">
					<v-btn
						class="hidden-md-and-down my-2"
						icon
						rounded="md"
						variant="plain"
						@click.stop="customizer.SET_MINI_SIDEBAR(!customizer.mini_sidebar)">
						<Icon
							icon="solar:hamburger-menu-line-duotone"
							height="25" />
					</v-btn>
				</div>

				<div :class="['miniicons mt-lg-0 mt-4', { 'pt-4': isHome }]">
					<div class="d-flex flex-column gap-2">
						<div
							class="miniicons-list px-4"
							v-for="menu in MiniSideIcons"
							:key="menu.icon">
							<v-btn
								rounded="md"
								flat
								icon
								variant="plain"
								@click="showData(menu.id)"
								:class="{ 'bg-primary opacity-1': currentMenu === menu.id }">
								<Icon
									:icon="'solar:' + menu.icon"
									width="25" />

								<v-tooltip
									activator="parent"
									location="end"
									class="custom-tooltip"
									>{{ menu.tooltip }}</v-tooltip
								>
							</v-btn>
						</div>
					</div>
				</div>
			</v-list-item>
		</perfect-scrollbar>
	</v-navigation-drawer> -->

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
						<template v-if="currentMenu == item.id">
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
									class="leftPadding"
									v-else />
							</template>
						</template>
					</template>
				</v-list>
			</div>
		</perfect-scrollbar>
	</v-navigation-drawer>
</template>
