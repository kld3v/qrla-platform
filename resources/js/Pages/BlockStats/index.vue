<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { computed, ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/QComponents/VenueTitleAndAddress.vue'
import QCard from '@/components/QComponents/QCard.vue'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QPlaqueActivityGraph from '@/components/QComponents/QPlaqueActivityGraph.vue'

import GraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'

import QDonutChart from '../../components/QComponents/QDonutChart.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
// import FIREFOXICON from '@/assets/images/svgs/.svg'
// import SAFARIICON from '@/assets/images/svgs/.svg'
import STADIUMCHAIRS from '@/assets/images/QAssets/VenuePerformance/asset1.png'
import QSelectableTable from '@/components/QComponents/QSelectableTable.vue'
import { Block, NavOptions, QColors, Stand } from '@/types'
import DeviceStats from './Partials/DeviceStats.vue'
import TapOrScanDonut from './Partials/TapOrScanDonut.vue'
import BrowserStats from './Partials/BrowserStats.vue'
import PlaqueTimeGraph from './Partials/PlaqueTimeGraph.vue'

const props = defineProps<{
	venue: VenuePageProps
	stands: Stand[]
	nav: NavOptions
}>()

console.log(props)

const selectedStand = ref<Stand>(props.stands[0])
const changeSelectedStand = (standName: string): void => {
	for (const stand of props.stands) {
		if (standName === stand.name) {
			selectedStand.value = stand
			console.log('Stand Updated')
			return
		}
	}
}
const selectedBlock = ref<Block>(props.stands[0].blocks[0])
const changeSelectedBlock = (blockId: number): void => {
	for (const block of selectedStand.value.blocks) {
		if (blockId === block.id) {
			selectedBlock.value = block
			console.log('Block Updated')
			console.log(selectedBlock.value)
			return
		}
	}
}
// to be relpaced with prop data
const IconCardData = ref<any>([
	{
		bg: 'primary-gradient',
		icon: 'lucide:nfc',
		color: 'primary',
		title: 'Total Visits',
		data: selectedBlock.value.stats.total_visits,
		link: '',
		delta: 40,
	},
	{
		bg: 'purple-gradient',
		icon: 'streamline:wave-signal-solid',
		color: 'purple',
		title: 'Visits By Tap',
		data: selectedBlock.value.stats.total_seat_visits,
		link: '',
		delta: -23,
	},
	{
		bg: 'success-gradient',
		icon: 'uil:qrcode-scan',
		color: 'success',
		title: 'Visits By Scan',
		data: selectedBlock.value.stats.total_block_visits,
		link: '',
		delta: 12,
	},
	{
		bg: 'error-gradient',
		icon: 'ic:baseline-sync-problem',
		color: 'error',
		title: 'Average Activity Level',
		data: '232',
		link: '',
		delta: 40,
	},
])

const returnSelectedStandBlocks = computed(() =>
	selectedStand.value.blocks.map((el) => {
		const circleColor: QColors = 'primary'
		return {
			code: el.name,
			name: selectedStand.value.name,
			circleColor: circleColor,
			id: el.id,
		}
	})
)
</script>
<template>
	<FullLayout
		:isGlobalHome="nav === 'home'"
		:venue="venue"
		:nav="nav">
		<HeaderImageAndLogo
			:bannerUrl="venue.banner_url"
			:logoUrl="venue.logo_url"
			class="mb-6" />
		<VenueTitleAndAddress
			:name="venue.name"
			:address-line1="venue.address_line1"
			:city="venue.city"
			class="mb-12" />
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Block Performance Tracker" />
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QCard bg="default-gray">
					<div class="flex justify-space-between align-center w-full">
						<div class="mb-4">
							<h2 class="q-text-qrla_green h2 mb-2">Select Block To View</h2>
							<!-- <GraphTimeScaleMenu /> -->
						</div>
						<QMenusAnchor
							menu-location="start"
							dropdown-button-color="secondary"
							:label="'Stand'"
							:initialSelectedItem="selectedStand.name"
							:change-selected-stand="changeSelectedStand"
							:dropdown-options="[...props.stands.map((el: Stand) => el.name)]"></QMenusAnchor>
					</div>
					<v-row>
						<v-col
							cols="12"
							lg="6">
							<QCard bg="dark-primary-gradient">
								<QSelectableTable
									:update-selected-block="changeSelectedBlock"
									select-strategy="single"
									:block-data="returnSelectedStandBlocks" />
							</QCard>
						</v-col>
						<v-col
							cols="12"
							lg="6"></v-col>
					</v-row>
				</QCard>
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QIconCardSet
					:block-name="selectedBlock.name"
					:IconCardData="IconCardData"
					bg="#151C25" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<PlaqueTimeGraph
					:selected-item="selectedBlock"
					id-type="block" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="4">
				<Suspense>
					<DeviceStats
						:selected-item="selectedBlock"
						id-type="block" />
				</Suspense>
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<Suspense>
					<BrowserStats
						:selected-item="selectedBlock"
						id-type="block" />
				</Suspense>
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<TapOrScanDonut :data="[selectedBlock.stats.total_block_visits, selectedBlock.stats.total_seat_visits]" />
			</v-col>
		</v-row>
	</FullLayout>
</template>
