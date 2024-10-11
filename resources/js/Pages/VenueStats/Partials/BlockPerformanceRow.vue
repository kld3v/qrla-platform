<template>
	<div class="mb-4">
		<div class="flex justify-space-between">
			<div>
				<p class="h2">Block J</p>
				<p class="h4">{{ visits }} Visits</p>
			</div>
			<p class="h4 align-self-end">{{ percentOfTotal }}%</p>
		</div>
		<div class="h-[8px] rounded-md mt-1 bg-white">
			<div
				:class="computedProgressBarClass"
				:style="{ width: `${percentOfTotal}%` }"></div>
		</div>
	</div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
	visits: number
	percentOfTotal: number
	progressBarColor: string
}>()

const computedProgressBarClass = computed(() => {
	return `bg-${props.progressBarColor} rounded-md h-[8px]`
})
</script>

<style></style>
