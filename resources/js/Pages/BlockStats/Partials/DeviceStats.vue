<template>
	<QCard
		bg="default-gray"
		class="flex flex-col gap-y-2">
		<h3 class="q-text-qrla_green h3 mb-2">Device Stats</h3>
		<p class="text-subtitle-1 mb-2">Most used devices by customers.</p>
		<v-row>
			<v-col
				cols="12"
				lg="12">
				<QCard bg="dark-primary-gradient">
					<div class="flex justify-space-between align-center">
						<span class="flex align-center">
							<img
								:src="APPLEICON"
								alt="Green Apple Icon" />
							<p class="ml-4 mt-2 muted">Apple</p></span
						>
						<p>23%</p>
					</div>
					<div class="flex justify-space-between align-center mt-4">
						<span class="flex align-center">
							<img
								:src="ANDROIDICONGREEN"
								alt="Green Android Icon" />
							<p class="ml-4 mt-1 muted">Android</p></span
						>
						<p>43%</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import APPLEICON from '@/assets/images/svgs/appleIcon.svg'
import ANDROIDICONGREEN from '@/assets/images/svgs/androidIcon.svg'
import { Block } from '@/types'
import QCard from '@/components/QComponents/QCard.vue'
import { watch } from 'vue'
import { getAccessesByOs } from '@/utils/apiDataFetchers'
import { VenuePageProps } from '@/types/Venue'
type IdType = 'venue' | 'block'

const props = defineProps<{
	// think of a more scalable way to type this
	selectedItem: Block | VenuePageProps
	idType: IdType
}>()

watch(
	() => {
		props.selectedItem
	},
	() => {
		getAccessesByOs(props.idType, props.selectedItem.id)
	}
)
</script>

<style></style>
