<script setup lang="ts">
import { Icon } from '@iconify/vue'

const props = defineProps<{
	title: string

	icon?: string

	bg?: string
}>()
</script>

<template>
	<v-card
		elevation="18"
		class="">
		<div class="px-6 py-4 default-gray">
			<div class="d-flex justify-space-between align-center">
				<h2 class="text-h2">{{ title }}</h2>
			</div>
		</div>
	</v-card>
</template>

<style lang="scss">
.page-breadcrumb {
	.v-toolbar {
		background: transparent;
	}
}

.default-gray {
	background-color: rgba(var(--v-theme-darkdefaultgray));
}
</style>
