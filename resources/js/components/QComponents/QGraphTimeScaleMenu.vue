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
import { TimeRange } from '@/types'
import { ref } from 'vue'

const props = defineProps<{
	handleTimeScaleChange: (timeScale: TimeRange) => void
}>()

const timeRangeOptions: { label: string; value: TimeRange }[] = [
	{ label: '1D', value: '1d' },
	{ label: '1W', value: '1w' },
	{ label: '1M', value: '1m' },
	{ label: '3M', value: '3m' },
	{ label: '1Y', value: '1y' },
	//NOTE CHANGE AFTER A YEAR OF OPERATION
	{ label: 'All', value: '1y' },
]

const selectedRange = ref<TimeRange>('3m') // Default selected range

const selectRange = (range: TimeRange) => {
	selectedRange.value = range
	props.handleTimeScaleChange(selectedRange.value)
}
</script>

<style scoped></style>
