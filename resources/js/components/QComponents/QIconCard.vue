<script setup lang="ts">
import { QCardType } from '@/types'
import { Icon } from '@iconify/vue'
const props = defineProps<{
	card: QCardType
}>()
</script>

<template>
	<v-card
		elevation="10"
		class="overflow-hidden"
		style="background-color: transparent">
		<v-card-item style="padding: 0">
			<div
				:key="card.bg"
				class="flex-1-0">
				<v-sheet
					:class="card.bg"
					class="py-8 px-8 rounded-md text-center !flex flex-row justify-between align-center">
					<div class="flex flex-row align-center">
						<v-avatar
							size="48"
							:color="card.color"
							class="rounded-full mr-3">
							<img
								:src="card.icon"
								height="25" />
						</v-avatar>
						<p class="font-black text-xl">{{ card.title }}</p>
					</div>
					<h3 class="text-h3 heading">{{ card.dataValue }}</h3>
					<Link
						v-if="card.link"
						:href="card.link"
						class="bg-surface mt-3 rounded-sm text-decoration-none text-body-2 font-weight-semibold btn-white elevation-9"
						>View Details</Link
					>
				</v-sheet>
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
	background: linear-gradient(180deg, rgba(var(--v-theme-primary), 0.04) 0, rgba(var(--v-theme-darkprimary), 0.02) 100%);
}
</style>
