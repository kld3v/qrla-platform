<template>
	<QCard bg="default-gray">
		<div class="flex justify-space-between align-center w-full">
			<h3 class="q-text-qrla_green h3 mb-2">Tap or Scan %</h3>
			<p class="text-subtitle-1">All time</p>
		</div>
		<QSpicyLoading v-if="loading"><p class="q-text-qrla_green">Compiling Data...</p></QSpicyLoading>
		<QDonutChart
			v-else
			:data="returnDonutDataFromState"
			:labels="returnDonutLabelsFromState" />
	</QCard>
</template>

<script setup lang="ts">
import QCard from '@/components/QComponents/QCard.vue'
import QDonutChart from '@/components/QComponents/QDonutChart.vue'
import { BlockExtended, IdType, VenuePageProps } from '@/types'
import { getAccessByMarkerType } from '@/utils/apiDataFetchers'
import { computed, ref, watch } from 'vue'
import QSpicyLoading from './QSpicyLoading.vue'
const props = defineProps<{
	selectedItem: BlockExtended | VenuePageProps
	idType: IdType
}>()
const loading = ref(false)
const data = ref<
	{
		marker_type: string
		access_percentage: number
	}[]
>([
	{ marker_type: 'seat', access_percentage: 50 },
	{ marker_type: 'block', access_percentage: 50 },
])

const returnDonutDataFromState = computed(() => {
	return data.value.map((el) => el.access_percentage)
})

const returnDonutLabelsFromState = computed(() => {
	return data.value.map((el) => {
		if (el.marker_type === 'seat') return 'Taps'
		if (el.marker_type === 'block') return 'Scans'
		return ''
	})
})
watch(
	() => props.selectedItem, // Explicitly watch the selectedItem prop
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			// Check if the value has actually changed
			loading.value = true
			let res = await getAccessByMarkerType(props.idType, props.selectedItem.id)
			loading.value = false
			data.value = res.data
		}
	},
	{ immediate: true } // Add immediate option if you want to call it on component mount as well
)
</script>

<style></style>
