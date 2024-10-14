<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/QComponents/VenueTitleAndAddress.vue'
import QCard from '@/components/QComponents/QCard.vue'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QPlaqueActivityGraph from '@/components/QComponents/QPlaqueActivityGraph.vue'

import GraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import APPLEICON from '@/assets/images/svgs/appleIcon.svg'
import ANDROIDICONGREEN from '@/assets/images/svgs/androidIcon.svg'
import GOOGLEICON from '@/assets/images/svgs/icon-chrome.svg'
import QDonutChart from '../../components/QComponents/QDonutChart.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
// import FIREFOXICON from '@/assets/images/svgs/.svg'
// import SAFARIICON from '@/assets/images/svgs/.svg'
import STADIUMCHAIRS from '@/assets/images/QAssets/VenuePerformance/asset1.png'
import QSelectableTable from '@/components/QComponents/QSelectableTable.vue'

const props = defineProps<{
	venue: VenuePageProps
}>()

const isGlobalHome = ref(false)

// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'primary-gradient',
		icon: 'lucide:nfc',
		color: 'primary',
		title: 'Total Visits',
		data: '16,689',
		link: '',
		delta: 40,
	},
	{
		bg: 'purple-gradient',
		icon: 'streamline:wave-signal-solid',
		color: 'purple',
		title: 'Visits By Tap',
		data: 'Sport',
		link: '',
		delta: -23,
	},
	{
		bg: 'success-gradient',
		icon: 'uil:qrcode-scan',
		color: 'success',
		title: 'Visits By Scan',
		data: '450',
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
]

const colors = ['primary', 'warning', 'success', 'purple']
</script>
<template>
	<FullLayout :isGlobalHome="isGlobalHome">
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
							<h3 class="q-text-qrla_green h3 mb-2">Select Block To View</h3>
							<GraphTimeScaleMenu />
						</div>
						<QMenusAnchor
							menu-location="start"
							dropdown-button-color="secondary"
							:dropdown-options="['Aug 2023', 'Sept 2023']"></QMenusAnchor>
					</div>
					<v-row>
						<v-col
							cols="12"
							lg="4">
							<QCard bg="dark-primary-gradient">
								<QSelectableTable
									:block-data="[
										{
											name: 'East Stand',
											code: 'EU1',
											circleColor: 'primary',
										},
									]" />
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
					:IconCardData="IconCardData"
					bg="#151C25" />
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QCard bg="default-gray">
					<GraphTimeScaleMenu class="flex gap-6 absolute right-20" />
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
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="4">
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
									<p>{{ venue.city }} 23%</p>
								</div>
								<div class="flex justify-space-between align-center mt-4">
									<span class="flex align-center">
										<img
											:src="ANDROIDICONGREEN"
											alt="Green Android Icon" />
										<p class="ml-4 mt-1 muted">Android</p></span
									>
									<p>{{ venue.city }} 43%</p>
								</div>
							</QCard>
						</v-col>
					</v-row>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="4">
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
										<p class="ml-4 mt-2 muted">Google</p></span
									>
									<p>{{ venue.city }} 23%</p>
								</div>
								<div class="flex justify-space-between align-center mt-4">
									<span class="flex align-center">
										<img
											:src="GOOGLEICON"
											alt="Green Android Icon" />
										<p class="ml-4 mt-1 muted">Android</p></span
									>
									<p>{{ venue.city }} 43%</p>
								</div>
								<div class="flex justify-space-between align-center mt-4">
									<span class="flex align-center">
										<img
											:src="GOOGLEICON"
											alt="Green Android Icon" />
										<p class="ml-4 mt-1 muted">Android</p></span
									>
									<p>{{ venue.city }} 43%</p>
								</div>
							</QCard>
						</v-col>
					</v-row>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="4">
				<QCard bg="default-gray">
					<div class="flex justify-space-between align-center w-full">
						<h3 class="q-text-qrla_green h3 mb-2">Tap or Scan %</h3>
						<p class="text-subtitle-1">All time</p>
					</div>
					<QDonutChart :labels="['Taps', 'Scans']" />
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
