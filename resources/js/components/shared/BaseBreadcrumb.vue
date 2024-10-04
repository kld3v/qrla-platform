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
		elevation="10"
		class="mb-8">
		<div class="px-6 py-4 bg-[#151C25]">
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
</style>
