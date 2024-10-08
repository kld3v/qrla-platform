<script setup lang="ts">
import { QCardType } from '@/types'

const props = defineProps<{
	bg: QCardType['bg'] | 'default-gray'
}>()
</script>

<template>
	<v-sheet
		:class="bg"
		elevation="12"
		class="py-8 px-8 rounded-md text-center h-full">
		<slot></slot>
	</v-sheet>
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
	background-color: rgba(var(--v-theme-darkdefaultgray));
}
</style>
