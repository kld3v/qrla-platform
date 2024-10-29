<template>
	<QCard bg="default-gray">
		<div class="flex justify-space-between align-center w-full">
			<h3 class="q-text-qrla_green h3 mb-2">Tap or Scan %</h3>
			<p class="text-subtitle-1">All time</p>
		</div>
		<QDonutChart
			:data="data"
			:labels="['Taps', 'Scans']" />
	</QCard>
</template>

<script setup lang="ts">
import QCard from '@/components/QComponents/QCard.vue'
import QDonutChart from '@/components/QComponents/QDonutChart.vue'
import { VenuePageProps } from '@/types'
import { getAccessByMarkerType } from '@/utils/apiDataFetchers'
import { onMounted } from 'vue'
const props = defineProps<{
	venue: VenuePageProps
	data: number[]
}>()
console.log(props)

onMounted(async () => {
	let res = await getAccessByMarkerType('venue', props.venue.id)
	console.log(res)
})
</script>

<style></style>
