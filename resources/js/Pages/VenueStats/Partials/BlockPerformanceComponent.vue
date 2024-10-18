<template>
	<QCard bg="default-gray">
		<div class="flex justify-space-between align-center w-full">
			<div class="mb-4">
				<h3 class="q-text-qrla_green h3 mb-6">Block Activity</h3>
				<QGraphTimeScaleMenu :handle-time-scale-change="handleTimeScaleChange" />
			</div>
			<QMenusAnchor
				:initial-selected-item="'selection'"
				label="Blocks"
				menu-location="start"
				dropdown-button-color="secondary"
				:dropdown-options="['Aug 2023', 'Sept 2023']"></QMenusAnchor>
		</div>
		<v-row>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="dark-primary-gradient">
					<p class="h4 mb-4">Top Performing Blocks</p>
					<!-- accesses-by-block -->
					<BlockPerformanceRow
						v-for="(item, index) in 4"
						:key="index"
						:visits="10"
						:percent-of-total="20 * (index + 1)"
						:progress-bar-color="colors[index]" />
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6"></v-col>
		</v-row>
		<v-row>
			<v-col
				cols="12"
				lg="12">
				<QCard bg="dark-primary-gradient">
					<div class="flex justify-space-between align-center">
						<p class="h4 mb-4">Block Performance Tracker</p>
						<Icon
							icon="material-symbols:stairs-outline"
							height="25"
							class="text-primary" />
					</div>
					<img
						:src="STADIUMCHAIRS"
						alt="Stadium Chairs"
						class="w-full mb-4" />
					<v-btn
						color="primary"
						class="w-full">
						View Individual Block Performance
					</v-btn>
				</QCard>
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import STADIUMCHAIRS from '@/assets/images/QAssets/VenuePerformance/asset1.png'
import QCard from '@/components/QComponents/QCard.vue'
import QGraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
import BlockPerformanceRow from './BlockPerformanceRow.vue'
import { getAccessesByBlockOverTime } from '@/utils/apiDataFetchers'
import { Block, IdType, TimeRange } from '@/types'
import { VenuePageProps } from '@/types/Venue'
import { onMounted, reactive } from 'vue'

const colors = ['primary', 'warning', 'success', 'purple']

const props = defineProps<{
	selectedItem: Block | VenuePageProps
}>()

// State for API results
const graphData = reactive({
	day: null,
	week: null,
	month: null,
	threeMonths: null,
	year: null,
	current: null, // for storing the current data passed to the graph
})

// Fetch data for different time scales
const fetchData = async () => {
	graphData.day = await getAccessesByBlockOverTime(props.selectedItem.id, '1d')
	graphData.week = await getAccessesByBlockOverTime(props.selectedItem.id, '1w')
	graphData.month = await getAccessesByBlockOverTime(props.selectedItem.id, '1m')
	graphData.threeMonths = await getAccessesByBlockOverTime(props.selectedItem.id, '3m')
	graphData.year = await getAccessesByBlockOverTime(props.selectedItem.id, '1y')

	graphData.current = graphData.threeMonths
}

onMounted(async () => {
	await fetchData()
	console.log(graphData)
})

const handleTimeScaleChange = (timeScale: TimeRange) => {
	switch (timeScale) {
		case '1d':
			graphData.current = graphData.day
			break
		case '1w':
			graphData.current = graphData.week
			break
		case '1m':
			graphData.current = graphData.month
			break
		case '3m':
			graphData.current = graphData.threeMonths
			break
		case '1y':
			graphData.current = graphData.year
			break
	}
}
</script>

<style></style>
