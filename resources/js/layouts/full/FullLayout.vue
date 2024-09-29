<script setup lang="ts">
import VerticalSidebarVue from './vertical-sidebar/VerticalSidebar.vue'
import VerticalHeaderVue from './vertical-header/VerticalHeader.vue'
import HorizontalHeader from './horizontal-header/HorizontalHeader.vue'
import HorizontalSidebar from './horizontal-sidebar/HorizontalSidebar.vue'
import Customizer from './customizer/Customizer.vue'
import { useCustomizerStore } from '../../stores/customizer'
import { pl, zhHans } from 'vuetify/locale'

const customizer = useCustomizerStore()
</script>

<template>
	<v-locale-provider>
		<v-app
			:theme="customizer.actTheme"
			class="bg-containerBg"
			:class="[
				customizer.actTheme,
				customizer.mini_sidebar ? 'mini-sidebar' : '',
				customizer.setHorizontalLayout ? 'horizontalLayout' : 'verticalLayout',
				customizer.setBorderCard ? 'cardBordered' : '',
			]">
			<!---Customizer location right side--->
			<v-navigation-drawer
				app
				temporary
				elevation="10"
				location="right"
				v-model="customizer.Customizer_drawer"
				width="320">
				<Customizer />
			</v-navigation-drawer>
			<VerticalSidebarVue v-if="!customizer.setHorizontalLayout" />
			<div :class="customizer.boxed ? 'maxWidth' : 'full-header'"><VerticalHeaderVue v-if="!customizer.setHorizontalLayout" /></div>
			<div :class="customizer.boxed ? 'maxWidth' : 'full-header'"><HorizontalHeader v-if="customizer.setHorizontalLayout" /></div>

			<v-main class="mr-md-4">
				<div class="mb-3 hr-layout bg-containerBg">
					<v-container
						fluid
						class="page-wrapper bg-background pt-md-8 rounded-xl">
						<div>
							<div :class="customizer.boxed ? 'maxWidth' : ''">
								<slot></slot>
							</div>
						</div>
					</v-container>
				</div>
			</v-main>
		</v-app>
	</v-locale-provider>
</template>
