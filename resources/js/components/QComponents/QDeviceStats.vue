<template>
	<QCard
		bg="default-gray"
		class="flex flex-col gap-y-2 h-full">
		<h3 class="q-text-qrla_green h3 mb-2">Device Stats</h3>
		<p class="text-subtitle-1 mb-2">Most used devices by customers.</p>
		<v-row>
			<v-col
				cols="12"
				lg="12">
				<QCard
					bg="dark-primary-gradient"
					style="height: 200px; display: flex; height: 200px; justify-content: space-evenly; flex-direction: column">
					<div class="flex justify-space-between align-center">
						<span class="flex align-center">
							<img
								:src="APPLEICON"
								alt="Green Apple Icon" />
							<p class="ml-4 mt-2 muted">Apple</p></span
						>
						<p>{{ stats.apple ? stats.apple : '0' }} %</p>
					</div>
					<div class="flex justify-space-between align-center mt-4">
						<span class="flex align-center">
							<img
								:src="ANDROIDICONGREEN"
								alt="Green Android Icon" />
							<p class="ml-4 mt-1 muted">Android</p></span
						>
						<p>{{ stats.android ? stats.android : '0' }} %</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import APPLEICON from '@/assets/images/svgs/appleIcon.svg'
import ANDROIDICONGREEN from '@/assets/images/svgs/androidIcon.svg'
import { BlockExtended, IdType } from '@/types'
import QCard from '@/components/QComponents/QCard.vue'
import { ref, watch } from 'vue'
import { getAccessesByOs } from '@/utils/apiDataFetchers'
import { VenuePageProps } from '@/types'

const props = defineProps<{
	// think of a more scalable way to type this
	selectedItem: BlockExtended | VenuePageProps
	idType: IdType
}>()

const stats = ref({
	apple: 0,
	android: 0,
})

watch(
	() => props.selectedItem, // Explicitly watch the selectedItem prop
	async (newVal, oldVal) => {
		if (newVal && newVal.id !== oldVal?.id) {
			// Check if the value has actually changed
			let res = await getAccessesByOs(props.idType, props.selectedItem.id)
			stats.value.apple = res.data.os[0]
			stats.value.android = res.data.os[1]
			console.log(res)
		}
	},
	{ immediate: true } // Add immediate option if you want to call it on component mount as well
)
</script>

<style></style>
