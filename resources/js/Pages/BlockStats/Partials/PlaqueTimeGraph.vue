<template>
	<QCard bg="default-gray">
		<QGraphTimeScaleMenu class="flex gap-6 absolute right-20" />
		<v-row>
			<v-col
				cols="12"
				lg="8"
				class="text-left flex flex-col gap-y-2">
				<h3 class="q-text-qrla_green h3">QRLA Plaque Activity</h3>
				<p class="text-subtitle-1">Overview of Tap or Scans through plaques</p>
				<QPlaqueActivityGraph />
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import QCard from '@/components/QComponents/QCard.vue'
import QGraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import QPlaqueActivityGraph from '@/components/QComponents/QPlaqueActivityGraph.vue'
import { Block, IdType } from '@/types'
import { VenuePageProps } from '@/types/Venue'
import { getAccessesOverTime } from '@/utils/apiDataFetchers'
import { watch } from 'vue'

const props = defineProps<{
	// think of a more scalable way to type this
	selectedItem: Block | VenuePageProps
	idType: IdType
}>()

watch(
	() => props.selectedItem,
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			let res_day = await getAccessesOverTime(props.idType, props.selectedItem.id, '1d')
			console.log('last day:', res_day)
			let res_week = await getAccessesOverTime(props.idType, props.selectedItem.id, '1w')
			console.log('last week:', res_week)
			let res_month = await getAccessesOverTime(props.idType, props.selectedItem.id, '1m')
			console.log('last month:', res_month)
			let res_3m = await getAccessesOverTime(props.idType, props.selectedItem.id, '3m')
			console.log('last 3m:', res_3m)
			let res_1y = await getAccessesOverTime(props.idType, props.selectedItem.id, '1y')
			console.log('last year: ', res_1y)
		}
	},
	{ immediate: true } // Add immediate option if you want to call it on component mount as well
)
</script>

<style></style>
