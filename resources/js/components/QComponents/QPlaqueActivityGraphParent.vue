<template>
	<QCard bg="default-gray">
		<QGraphTimeScaleMenu
			:handle-time-scale-change="handleTimeScaleChange"
			class="flex gap-6 absolute right-20" />
		<v-row>
			<v-col
				cols="12"
				lg="10"
				class="text-left flex flex-col gap-y-2">
				<h3 class="q-text-qrla_green h3">QRLA Plaque Activity</h3>
				<p class="text-subtitle-1">Overview of Tap or Scans through plaques</p>
				<p v-if="loading">Loading...</p>
				<QPlaqueActivityGraph
					v-else
					:data="graphData?.current?.data" />
			</v-col>
			<v-col
				cols="12"
				lg="2"
				class="mt-16">
				<PlaqueGraphStatsIcons />
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import { watch, reactive, ref } from 'vue'
import QCard from '@/components/QComponents/QCard.vue'
import QGraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import QPlaqueActivityGraph from '@/components/QComponents/QPlaqueActivityGraph.vue'
import { getAccessesOverTime } from '@/utils/apiDataFetchers'
import { Block, IdType, TimeRange } from '@/types'
import { VenuePageProps } from '@/types/Venue'
import PlaqueGraphStatsIcons from '@/components/QComponents/QPlaqueTimeGraphStatsIcons.vue'
// Define Props
const props = defineProps<{
	selectedItem: Block | VenuePageProps
	idType: IdType
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

// Loading Icon
const loading = ref(false)

// Fetch data for different time scales
const fetchData = async () => {
	graphData.day = await getAccessesOverTime(props.idType, props.selectedItem.id, '1d')
	graphData.week = await getAccessesOverTime(props.idType, props.selectedItem.id, '1w')
	graphData.month = await getAccessesOverTime(props.idType, props.selectedItem.id, '1m')
	graphData.threeMonths = await getAccessesOverTime(props.idType, props.selectedItem.id, '3m')
	graphData.year = await getAccessesOverTime(props.idType, props.selectedItem.id, '1y')

	// Set initial data for graph (e.g., default to last day) This needs to match the default value in the time scale menu
	graphData.current = graphData.threeMonths
}

// Watch for changes in the selected item and refetch data if necessary
watch(
	() => props.selectedItem,
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			loading.value = !loading.value
			await fetchData()
			loading.value = !loading.value
		}
	},
	{ immediate: true }
)

// Function to handle time scale change
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
