<script setup lang="ts">
import { computed } from 'vue'
import { Icon } from '@iconify/vue'

/* Chart */
const areachartOptions = computed(() => {
	return {
		chart: {
			toolbar: {
				show: false,
			},
			type: 'area',
			fontFamily: 'inherit',
			foreColor: '#fff',
			height: 290,
			width: '100%',
			stacked: false,
		},
		colors: ['#A2F732', '#635BFF', '#14E9E2'],
		plotOptions: {},
		dataLabels: {
			enabled: false,
		},
		legend: {
			show: false,
		},
		stroke: {
			width: 2,
			curve: 'monotoneCubic',
		},
		grid: {
			show: true,
			padding: {
				top: 0,
				bottom: 0,
			},
			borderColor: '#2C4E26',
			xaxis: {
				lines: {
					show: true,
				},
			},
			yaxis: {
				lines: {
					show: true,
				},
			},
		},
		fill: {
			type: 'gradient',
			gradient: {
				shadeIntensity: 4,
				inverseColors: false,
				opacityFrom: 0.2,
				opacityTo: 0.9,
				stops: [100],
			},
		},
		xaxis: {
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false,
			},
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov'],
		},
		markers: {
			strokeColor: ['#A2F732', '#635BFF', '#14E9E2'],
			strokeWidth: 2,
		},
		tooltip: {
			theme: 'dark',
		},
	}
})

const areaChart = {
	series: [
		{
			name: 'Total',
			data: [50, 60, 30, 55, 75, 60, 100, 120, 100, 90, 100],
		},

		{
			name: 'Taps',
			data: [35, 45, 40, 50, 35, 55, 40, 45, 100, 90, 10],
		},
		{
			name: 'Scans',
			data: [100, 75, 80, 40, 20, 40, 0, 25, 100, 90, 50],
		},
	],
}
</script>
<template>
	<v-card
		elevation="12"
		class="primary-gradient">
		<v-card-item class="pb-2">
			<div class="d-md-flex justify-space-between mb-mb-0 mb-3">
				<div class="d-flex gap-3 align-center">
					<v-avatar
						size="48"
						class="rounded-md q-primary-gradient">
						<Icon
							icon="solar:layers-linear"
							class="text-primary"
							height="25" />
					</v-avatar>
					<div>
						<v-card-title class="text-h5">Activity</v-card-title>
						<v-card-subtitle class="text-subtitle-1">Past Year</v-card-subtitle>
					</div>
				</div>
				<div class="d-flex align-center gap-4">
					<div class="d-flex align-center gap-2">
						<v-avatar
							size="8"
							class="bg-primary rounded-circle"></v-avatar>
						<span class="textSecondary">Total</span>
					</div>
					<div class="d-flex align-center gap-2">
						<v-avatar
							size="8"
							class="!bg-[#635bff] rounded-circle"></v-avatar>
						<span class="textSecondary">Taps</span>
					</div>
					<div class="d-flex align-center gap-2">
						<v-avatar
							size="8"
							class="bg-success rounded-circle"></v-avatar>
						<span class="textSecondary">Scans</span>
					</div>
				</div>
			</div>
			<div class="mx-n4 mt-5 pt-2">
				<apexchart
					type="area"
					height="290"
					:options="areachartOptions"
					:series="areaChart.series">
				</apexchart>
			</div>
		</v-card-item>
	</v-card>
</template>

<style>
.primary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-primary), 0.12) 0, rgba(var(--v-theme-primary), 0.03) 100%);
}
</style>
