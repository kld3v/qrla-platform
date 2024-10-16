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
				<QCard bg="dark-primary-gradient">
					<div class="flex justify-space-between align-center">
						<span class="flex align-center">
							<img
								:src="GOOGLEICON"
								alt="Green Apple Icon" />
							<p class="ml-4 mt-2 muted">Chrome</p></span
						>
						<p>{{ stats.chrome ? stats.chrome : 0 }} %</p>
					</div>
					<div class="flex justify-space-between align-center mt-4">
						<span class="flex align-center">
							<img
								:src="GOOGLEICON"
								alt="Green Android Icon" />
							<p class="ml-4 mt-1 muted">Firefox</p></span
						>
						<p>{{ stats.firefox ? stats.firefox : 0 }} %</p>
					</div>
					<div class="flex justify-space-between align-center mt-4">
						<span class="flex align-center">
							<img
								:src="GOOGLEICON"
								alt="Green Android Icon" />
							<p class="ml-4 mt-1 muted">Edge</p></span
						>
						<p>{{ stats.edge ? stats.edge : 0 }} %</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import GOOGLEICON from '@/assets/images/svgs/icon-chrome.svg'
import { Block } from '@/types'
import QCard from '@/components/QComponents/QCard.vue'
import { ref, watch } from 'vue'
import { getAccessesByOs } from '@/utils/apiDataFetchers'
import { VenuePageProps } from '@/types/Venue'
type IdType = 'venue' | 'block'

const props = defineProps<{
	// think of a more scalable way to type this
	selectedItem: Block | VenuePageProps
	idType: IdType
}>()

const stats = ref({
	chrome: 0,
	firefox: 0,
	edge: 0,
})

watch(
	() => props.selectedItem, // Explicitly watch the selectedItem prop
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			// Check if the value has actually changed
			let res = await getAccessesByOs(props.idType, props.selectedItem.id)
			stats.value.chrome = res.data.browsers[0]
			stats.value.firefox = res.data.browsers[1]
			stats.value.edge = res.data.browsers[2]
			console.log(`Browser Stats updated with block id: ${newVal.id}`)
		}
	},
	{ immediate: true } // Add immediate option if you want to call it on component mount as well
)
</script>

<style></style>
