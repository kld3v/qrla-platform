<template>
	<QCard
		bg="default-gray"
		class="text-left">
		<h3 class="q-text-qrla_green h3 mb-2">Browser Stats</h3>
		<p class="text-subtitle-1 mb-2">Most used browsers by customers.</p>
		<v-row>
			<v-col
				cols="12"
				lg="12">
				<QCard
					bg="dark-primary-gradient"
					custom-css="flex flex-col justify-space-between"
					style="height: 200px; display: flex; height: auto; justify-content: space-evenly; flex-direction: column">
					<p v-if="loading">Loading</p>
					<div
						v-for="(value, browser) in stats"
						class="flex justify-space-between align-center">
						<span class="flex align-center mt-2">
							<img
								:src="GOOGLEICON"
								alt="Green Apple Icon" />
							<p class="ml-4 mt-2 muted">{{ browser }}</p></span
						>
						<p>{{ browser ? value : 0 }} %</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import GOOGLEICON from '@/assets/images/svgs/icon-chrome.svg'
import { BlockExtended } from '@/types'
import QCard from '@/components/QComponents/QCard.vue'
import { ref, watch } from 'vue'
import { getAccessesByOsAndBrowser } from '@/utils/apiDataFetchers'
import { VenuePageProps } from '@/types'
import { DeviceBrowserDataObject } from '@/types'
type IdType = 'venue' | 'block'

const props = defineProps<{
	// think of a more scalable way to type this
	selectedItem: BlockExtended | VenuePageProps
	idType: IdType
}>()

const stats = ref({
	Chrome: 0,
	Firefox: 0,
	Edge: 0,
})

function updateDeviceStats(array: DeviceBrowserDataObject[]) {
	array.forEach((obj) => {
		stats.value[obj.browser as keyof typeof stats.value] = obj.access_percentage
	})
}
const loading = ref(false)
watch(
	() => props.selectedItem, // Explicitly watch the selectedItem prop
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			// Check if the value has actually changed
			loading.value = true
			let res = await getAccessesByOsAndBrowser(props.idType, props.selectedItem.id)
			updateDeviceStats(res.data.browsers)
			loading.value = false
			console.log(res, stats.value)
		}
	},
	{ immediate: true } // Add immediate option if you want to call it on component mount as well
)
</script>

<style></style>
