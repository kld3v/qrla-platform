<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QPlaqueActivityGraphParent from '@/components/QComponents/QPlaqueActivityGraphParent.vue'
import { NavOptions, Stand, VenuePageProps } from '@/types'
import QDeviceStats from '@/components/QComponents/QDeviceStats.vue'
import QBrowserStats from '@/components/QComponents/QBrowserStats.vue'
import QTapOrScanDonut from '@/components/QComponents/QTapOrScanDonut.vue'
import BlockPerformanceComponent from './Partials/BlockPerformanceComponent.vue'
import { formatNumberWithCommas } from '@/utils/helpers/numbers'

const props = defineProps<{
	venue: VenuePageProps
	stats: any
	stands: Stand[]
	nav: NavOptions
}>()
const isGlobalHome = ref(false)

// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'primary-gradient',
		icon: 'iconamoon:eye',
		color: 'primary',
		title: 'Total Visits',
		data: formatNumberWithCommas(props.stats.total_visits),
		link: '',
	},
	{
		bg: 'purple-gradient',
		icon: 'lucide:nfc',
		color: 'purple',
		title: 'Visits By Tap',
		data: formatNumberWithCommas(props.stats.total_seat_visits),
		link: '',
	},
	{
		bg: 'success-gradient',
		icon: 'uil:qrcode-scan',
		color: 'success',
		title: 'Visits By Scan',
		data: formatNumberWithCommas(props.stats.total_block_visits),
		link: '',
	},
	{
		bg: 'error-gradient',
		icon: 'ph:chart-line-up',
		color: 'error',
		title: 'Average Activity Level',
		data: props.venue.access_rate,
		link: '',
	},
]
</script>
<template>
	<FullLayout
		:isGlobalHome="isGlobalHome"
		:venue="venue"
		:nav="nav">
		<HeaderImageAndLogo
			:bannerUrl="venue.banner_url"
			:logoUrl="venue.logo_url"
			:name="venue.name"
			:address-line1="venue.address_line1"
			:city="venue.city"
			class="mb-6" />

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Venue Performance Tracker" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QIconCardSet
					:IconCardData="IconCardData"
					bg="#151C25" />
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QPlaqueActivityGraphParent
					id-type="venue"
					:selected-item="venue" />
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="4">
				<QDeviceStats
					id-type="venue"
					:selected-item="venue" />
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<QBrowserStats
					id-type="venue"
					:selected-item="venue" />
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<QTapOrScanDonut
					:selected-item="venue"
					id-type="venue"
					:data="[stats.total_block_visits, stats.total_seat_visits]" />
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<BlockPerformanceComponent
					:selected-item="venue"
					:stands="stands" />
			</v-col>
		</v-row>
	</FullLayout>
</template>
