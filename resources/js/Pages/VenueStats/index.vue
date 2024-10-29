<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import VenueTitleAndAddress from '@/components/QComponents/VenueTitleAndAddress.vue'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QPlaqueActivityGraphParent from '@/components/QComponents/QPlaqueActivityGraphParent.vue'
import { NavOptions, Stand, VenuePageProps } from '@/types'
import QDeviceStats from '@/components/QComponents/QDeviceStats.vue'
import QBrowserStats from '@/components/QComponents/QBrowserStats.vue'
import QTapOrScanDonut from '@/components/QComponents/QTapOrScanDonut.vue'
import BlockPerformanceComponent from './Partials/BlockPerformanceComponent.vue'

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
		icon: 'lucide:nfc',
		color: 'primary',
		title: 'Venue Capacity',
		data: props.venue.capacity,
		link: '',
	},
	{
		bg: 'purple-gradient',
		icon: 'iconamoon:eye',
		color: 'purple',
		title: 'Venue Type',
		data: props.venue.type,
		link: '',
	},
	{
		bg: 'success-gradient',
		icon: 'uil:qrcode-scan',
		color: 'success',
		title: 'QRLA Plaques',
		data: props.venue.plaques,
		link: '',
	},
	{
		bg: 'error-gradient',
		icon: 'ph:chart-line-up',
		color: 'error',
		title: 'Managed By',
		data: props.venue.organisation.name,
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
					:labels="['Taps', 'Scans']"
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
