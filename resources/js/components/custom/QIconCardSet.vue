<script setup lang="ts">
import { Icon } from '@iconify/vue'

// TODO this will be passed as props eventually.
const IconcardData = [
	{
		bg: 'dark-primary-gradient',
		icon: 'solar:dollar-minimalistic-linear',
		color: 'primary',
		title: 'Venue Capacity',
		data: '16,689',
		link: false,
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'solar:recive-twice-square-linear',
		color: 'warning',
		title: 'Venue Type',
		data: 'Sport',
		link: false,
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:outline-backpack',
		color: 'secondary',
		title: 'QRLA Plaques',
		data: '450',
		link: false,
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:baseline-sync-problem',
		color: 'error',
		title: 'Managed By',
		data: 'Levy UK & Ireland',
		link: false,
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:outline-forest',
		color: 'success',
		title: 'Activity Level',
		data: '+86%',
		link: false,
	},
]
</script>

<template>
	<v-card
		elevation="10"
		class="overflow-hidden">
		<v-card-item class="bg-[#151C25]">
			<div class="grid grid-cols-5 gap-4">
				<div
					v-for="card in IconcardData"
					:key="card.bg"
					class="flex-1-0">
					<v-sheet
						:class="card.bg"
						class="py-8 px-3 rounded-md text-center">
						<img
							src=""
							alt="" />
						<p class="mb-1">{{ card.title }}</p>
						<h3 class="text-h3 heading mb-5">{{ card.data }}</h3>
						<Link
							v-if="card.link"
							:href="card.link"
							class="bg-surface mt-3 rounded-sm text-decoration-none text-body-2 font-weight-semibold btn-white elevation-9"
							>View Details</Link
						>
					</v-sheet>
				</div>
			</div>
		</v-card-item>
	</v-card>
</template>

<style lang="scss" scoped>
.primary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-primary), 0.12) 0, rgba(var(--v-theme-primary), 0.03) 100%);
}

.warning-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-warning), 0.12) 0, rgba(var(--v-theme-warning), 0.03) 100%);
}

.secondary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-secondary), 0.12) 0, rgba(var(--v-theme-secondary), 0.03) 100%);
}

.error-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-error), 0.12) 0, rgba(var(--v-theme-error), 0.03) 100%);
}

.success-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-success), 0.12) 0, rgba(var(--v-theme-success), 0.03) 100%);
}

.dark-primary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-darkprimary), 0.2) 0, rgba(var(--v-theme-darkprimary), 0.05) 100%);
}
</style>
