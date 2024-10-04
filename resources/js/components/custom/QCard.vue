<script setup lang="ts">
import { QCardType } from '@/types'
import { Icon } from '@iconify/vue'
const props = defineProps<{
	bg: QCardType['bg'] | 'default-gray'
}>()
</script>

<template>
	<v-card
		elevation="10"
		class="overflow-hidden">
		<v-card-item style="padding: 0">
			<div
				:key="bg"
				class="flex-1-0">
				<v-sheet
					:class="bg"
					class="py-8 px-8 rounded-md text-center !flex flex-row justify-between align-center">
					<slot></slot>
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
	background: linear-gradient(180deg, rgba(var(--v-theme-darkprimary), 0.2) 0, rgba(var(--v-theme-darkprimary), 0.05) 100%);
}

.default-gray {
	background-color: #151c25;
}
</style>
