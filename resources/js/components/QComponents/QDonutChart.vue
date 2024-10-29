<template>
	<apexchart
		type="donut"
		height="300"
		:options="donutchartOptions"
		:series="donutChart.series">
	</apexchart>
</template>

<script setup lang="ts">
import { computed } from 'vue'
const props = defineProps<{
	labels: string[]
	data: number[]
}>()

const donutchartOptions = computed(() => {
	return {
		chart: {
			type: 'donut',
			height: 300,
			fontFamily: `inherit`,
			foreColor: '#adb0bb',
		},
		dataLabels: {
			enabled: false,
		},
		labels: props.labels,
		plotOptions: {
			pie: {
				donut: {
					size: '70px',
				},
			},
		},
		stroke: {
			width: 2,
			colors: 'rgba(var(--v-theme-white))',
		},
		legend: {
			show: true,
			position: 'bottom',
			width: '50px',
		},
		colors: ['rgba(var(--v-theme-purple ))', 'rgba(var(--v-theme-success))'],
		responsive: [
			{
				breakpoint: 480,
				options: {
					chart: {
						width: 200,
					},
					legend: {
						position: 'bottom',
					},
				},
			},
		],
	}
})

const donutChart = {
	series: props.data,
}
</script>

<style></style>
