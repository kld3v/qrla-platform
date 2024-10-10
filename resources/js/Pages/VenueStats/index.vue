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
import PlaqueGraphStatsIcons from './Partials/PlaqueGraphStatsIcons.vue'
import GraphTimeScaleMenu from './Partials/GraphTimeScaleMenu.vue'
import APPLEICON from '@/assets/images/svgs/appleIcon.svg'
import ANDROIDICONGREEN from '@/assets/images/svgs/androidIcon.svg'
import GOOGLEICON from '@/assets/images/svgs/icon-chrome.svg'
import QDonutChart from '../../components/QComponents/QDonutChart.vue'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
// import FIREFOXICON from '@/assets/images/svgs/.svg'
// import SAFARIICON from '@/assets/images/svgs/.svg'
const props = defineProps<{
	venue: VenuePageProps
}>()

const isGlobalHome = ref(false)

// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'primary-gradient',
		icon: 'solar:dollar-minimalistic-linear',
		color: 'primary',
		title: 'Venue Capacity',
		data: '16,689',
		link: '',
	},
	{
		bg: 'info-gradient',
		icon: 'streamline:wave-signal-solid',
		color: 'warning',
		title: 'Venue Type',
		data: 'Sport',
		link: '',
	},
	{
		bg: 'success-gradient',
		icon: 'ic:outline-backpack',
		color: 'secondary',
		title: 'QRLA Plaques',
		data: '450',
		link: '',
	},
	{
		bg: 'error-gradient',
		icon: 'ic:baseline-sync-problem',
		color: 'error',
		title: 'Managed By',
		data: 'Levy UK & Ireland',
		link: '',
	},
]
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
				<QCard bg="default-gray">
					<GraphTimeScaleMenu />
					<v-row>
						<v-col
							cols="12"
							lg="8"
							class="text-left flex flex-col gap-y-2">
							<h3 class="q-text-qrla_green h3">QRLA Plaque Activity</h3>
							<p class="text-subtitle-1">Overview of Tap or Scans through plaques</p>
							<QPlaqueActivityGraph />
						</v-col>
						<v-col
							cols="12"
							lg="4"
							class="flex flex-col justify-center gap-y-8">
							<PlaqueGraphStatsIcons />
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

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QCard bg="default-gray">
					<div class="flex justify-space-between align-center w-full">
						<h3 class="q-text-qrla_green h3 mb-2">Block Activity</h3>
						<QMenusAnchor
							menu-location="start"
							dropdown-button-color="secondary"
							:dropdown-options="['Aug 2023', 'Sept 2023']"></QMenusAnchor>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
