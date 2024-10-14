<template>
	<div class="flex gap-6">
		<v-btn
			v-for="option in timeRangeOptions"
			:key="option.value"
			size="40"
			tile
			style="font-weight: 100; width: 48px"
			:class="['rounded-md', selectedRange === option.value ? 'bg-primary' : 'q-dark-primary-gradient']"
			@click="selectRange(option.value)">
			{{ option.label }}
		</v-btn>
	</div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const timeRangeOptions = [
	{ label: '1D', value: '1d' },
	{ label: '1W', value: '1w' },
	{ label: '1M', value: '1m' },
	{ label: '3M', value: '3m' },
	{ label: '1Y', value: '1y' },
	{ label: 'All', value: 'all' },
]

const selectedRange = ref('1y') // Default selected range

const selectRange = (range: string) => {
	selectedRange.value = range
}
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
