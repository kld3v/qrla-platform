<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { computed, onMounted, ref } from 'vue'
import VenueTitleAndAddress from '@/components/QComponents/VenueTitleAndAddress.vue'
import QCard from '@/components/QComponents/QCard.vue'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
import QSelectableTable from '@/components/QComponents/QSelectableTable.vue'
import { BlockExtended, NavOptions, QColors, Stand, VenuePageProps } from '@/types'
import QDeviceStats from '@/components/QComponents/QDeviceStats.vue'
import QTapOrScanDonut from '@/components/QComponents/QTapOrScanDonut.vue'
import QBrowserStats from '@/components/QComponents/QBrowserStats.vue'
import QPlaqueTimeGraph from '@/components/QComponents/QPlaqueActivityGraphParent.vue'
import QInteractiveVenueMap from '@/components/QComponents/QInteractiveVenueMap.vue'

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
			console.log('Stand Updated', selectedStand.value)
			return
		}
	}
}
const selectedBlocks = ref<BlockExtended[]>([props.stands[0].blocks[2]])

const updateSelectedBlockState = (blocks: BlockExtended[]) => {
	// Use slice instead of splice to avoid modifying the original array
	selectedBlocks.value = blocks.slice(blocks.length - 1, blocks.length)

	console.log('new Mr Selected Blocks', selectedBlocks.value)
}

const assignColorsToBlocks = (): void => {
	const colors = ['#14E9E2', '#FFAE1F', '#ff6692', '#635BFF', '#ffffff', '#33FFF3']
	props.stands.forEach((stand, index) => {
		const color = colors[index % colors.length]

		stand.blocks.forEach((block: BlockExtended) => {
			block.color = color
		})
	})
}

onMounted(() => {
	assignColorsToBlocks()
})

// to be relpaced with prop data
const IconCardData = ref<any>([
	{
		bg: 'primary-gradient',
		icon: 'lucide:nfc',
		color: 'primary',
		title: 'Total Visits',
		data: selectedBlocks.value[0].stats.total_visits,
		link: '',
		delta: 40,
	},
	{
		bg: 'purple-gradient',
		icon: 'streamline:wave-signal-solid',
		color: 'purple',
		title: 'Visits By Tap',
		data: selectedBlocks.value[0].stats.total_seat_visits,
		link: '',
		delta: -23,
	},
	{
		bg: 'success-gradient',
		icon: 'uil:qrcode-scan',
		color: 'success',
		title: 'Visits By Scan',
		data: selectedBlocks.value[0].stats.total_block_visits,
		link: '',
		delta: 12,
	},
	{
		bg: 'error-gradient',
		icon: 'ic:baseline-sync-problem',
		color: 'error',
		title: 'Average Activity Level',
		data: selectedBlocks.value[0].access_rate,
		link: '',
		delta: 40,
	},
])

const returnSelectedStandBlocksForTable = computed(() => selectedStand.value.blocks.map((el: BlockExtended) => el))
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
									:selected-blocks="selectedBlocks"
									:update-selected-block-state="updateSelectedBlockState"
									select-strategy="single"
									:block-data="returnSelectedStandBlocksForTable" />
							</QCard>
						</v-col>
						<v-col
							cols="12"
							lg="6">
							<QInteractiveVenueMap
								:updateSelectedBlockState="updateSelectedBlockState"
								:svgUrl="venue.map_svg_url"
								:stands="stands"
								:selected-blocks="selectedBlocks" />
						</v-col>
					</v-row>
				</QCard>
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QIconCardSet
					:block-name="selectedBlocks[0].name"
					:IconCardData="IconCardData"
					bg="#151C25" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QPlaqueTimeGraph
					:selected-item="selectedBlocks[0]"
					id-type="block" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="4">
				<Suspense>
					<QDeviceStats
						:selected-item="selectedBlocks[0]"
						id-type="block" />
				</Suspense>
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<Suspense>
					<QBrowserStats
						:selected-item="selectedBlocks[0]"
						id-type="block" />
				</Suspense>
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<QTapOrScanDonut :data="[selectedBlocks[0].stats.total_block_visits, selectedBlocks[0].stats.total_seat_visits]" />
			</v-col>
		</v-row>
	</FullLayout>
</template>
