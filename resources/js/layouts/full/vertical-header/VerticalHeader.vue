<script setup lang="ts">
import { ref, watch, computed } from 'vue'
import { useCustomizerStore } from '../../../stores/customizer'
import { useEcomStore } from '@/stores/apps/eCommerce'

import NotificationDD from './NotificationDD.vue'
import ProfileDD from './ProfileDD.vue'
import Searchbar from './Searchbar.vue'
import RightMobileSidebar from './RightMobileSidebar.vue'
import Navigations from './Navigations.vue'
import { Icon } from '@iconify/vue'
import Logo from '../logo/Logo.vue'
import ThemeToggler from './ThemeToggler.vue'
const customizer = useCustomizerStore()
const showSearch = ref(false)
const priority = ref(customizer.setHorizontalLayout ? 0 : 0)
function searchbox() {
	showSearch.value = !showSearch.value
}
watch(priority, (newPriority) => {
	priority.value = newPriority
})

// count items
const store = useEcomStore()
const getCart = computed(() => {
	return store.cart
})
</script>

<template>
	<v-app-bar
		elevation="0"
		:priority="priority"
		height="70"
		id="top"
		class="main-head">
		<v-btn
			class="hidden-lg-and-up custom-hover-primary"
			size="small"
			variant="text"
			color="primary"
			icon
			@click.stop="customizer.SET_SIDEBAR_DRAWER">
			<Icon
				icon="solar:hamburger-menu-line-duotone"
				height="22" />
		</v-btn>

		<!-- ---------------------------------------------- -->
		<!-- Search part -->
		<!-- ---------------------------------------------- -->
		<!-- <Searchbar /> -->

		<!-- ---------------------------------------------- -->
		<!-- Mega menu -->
		<!-- ---------------------------------------------- -->
		<!-- <div class="hidden-sm-and-down">
			<Navigations />
		</div> -->

		<v-spacer class="hidden-sm-and-down" />

		<!-- ---------------------------------------------- -->
		<!-- Mobile Logo -->
		<!-- ---------------------------------------------- -->
		<div class="hidden-md-and-up">
			<Logo />
		</div>

		<ThemeToggler />

		<!-- Notification -->
		<!-- ---------------------------------------------- -->
		<div class="hidden-sm-and-down">
			<NotificationDD />
		</div>

		<!-- ---------------------------------------------- -->
		<!-- User Profile -->
		<!-- ---------------------------------------------- -->
		<div class="hidden-sm-and-down">
			<ProfileDD />
		</div>

		<!----Mobile ----->
		<v-menu
			:close-on-content-click="true"
			class="mobile_popup">
			<template v-slot:activator="{ props }">
				<v-btn
					icon
					class="hidden-md-and-up custom-hover-primary"
					color="primary"
					variant="text"
					v-bind="props"
					size="small">
					<Icon
						icon="solar:menu-dots-bold-duotone"
						height="22" />
				</v-btn>
			</template>
			<v-sheet
				rounded="lg"
				elevation="10"
				class="mt-4 dropdown-box px-4 py-3">
				<div class="d-flex justify-space-between align-center">
					<RightMobileSidebar />
					<LanguageDD />
					<v-btn
						icon
						variant="text"
						class="mr-sm-3 mr-2 custom-hover-primary"
						to="/ecommerce/checkout"
						size="small">
						<v-badge
							color="primary"
							:content="getCart?.length"
							offset-x="-4"
							offset-y="-6">
							<Icon
								icon="solar:cart-large-2-outline"
								height="22" />
						</v-badge>
					</v-btn>
					<NotificationDD />
					<ProfileDD />
				</div>
			</v-sheet>
		</v-menu>
	</v-app-bar>
</template>
