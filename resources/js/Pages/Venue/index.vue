<script setup lang="ts">
import QSubsectionHeader from '@/components/custom/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/custom/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/custom/VenueTitleAndAddress.vue'
import QIconCardSet from '@/components/custom/QIconCardSet.vue'
import QCard from '@/components/custom/QCard.vue'
import HorizontalPlaque from '@/assets/images/QAssets/chelspng 1horizontal_plaque.png'
import QCARDSTADICON from '@/assets/images/svgs/stadium_icon.svg'
import QPLAQUEMANAGEMENTDASHBOARDIMAGE from '@/assets/images/QAssets/Venues/asset1.png'
import QVENUEPERFORMANCEIMAGE from '@/assets/images/QAssets/Venues/asset2.png'
import QBLOCKPERFORMANCEIMAGE from '@/assets/images/QAssets/Venues/asset3.png'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
	venue: VenuePageProps
}>()

const isGlobalHome = ref(false)

// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'dark-primary-gradient',
		color: 'primary',
		title: 'Venue Capacity',
		data: '16,689',
		link: '',
		image: QCARDSTADICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'warning',
		title: 'Venue Type',
		data: 'Sport',
		link: '',
		image: QCARDSTADICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'secondary',
		title: 'QRLA Plaques',
		data: '450',
		link: '',
		image: QCARDSTADICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'error',
		title: 'Managed By',
		data: 'Levy UK & Ireland',
		link: '',
		image: QCARDSTADICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'success',
		title: 'Activity Level',
		data: '+86%',
		link: '',
		image: QCARDSTADICON,
	},
]
</script>
<template>
	<FullLayout
		:isGlobalHome="isGlobalHome"
		:venue="venue">
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
				<QSubsectionHeader title="Venue Home" />
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
				<QCard bg="dark-primary-gradient">
					<div class="flex justify-center gap-x-8 align-center">
						<div class="text-left flex flex-col gap-4 max-w-[400px]">
							<h3>Your Qrla Plaques!</h3>
							<p>Your plaques have been scanned a total of //$InsertDataProp$// times at {{ venue.name }}!</p>
							<v-btn class="q-btn-green w-full">Check</v-btn>
						</div>
						<img
							:src="HorizontalPlaque"
							class="h-full mt-2"
							alt="HorizontalPlaque" />
					</div>
				</QCard>
			</v-col>
		</v-row>
		<v-row class="mb-3">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="QRLA Management Dashboard" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="flex flex-col text-left gap-4">
						<h3 class="h3">Plaque Management Dashboard</h3>
						<img
							:src="QPLAQUEMANAGEMENTDASHBOARDIMAGE"
							class="w-full" />
						<Link :href="route('venues.index')">
							<v-btn class="q-btn-green w-full">Manage Plaques</v-btn>
						</Link>
					</div>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="text-left gap-4 flex flex-col h-full">
						<h3 class="h3 q-text-qrla_green">What is the QRLA management dashboard?</h3>

						<p>View and manage all your plaques from one central dashboard, making amendments and edits easy and efficient.</p>

						<p>Manage your plaques en mass or select individual blocks to manage your blocks by.</p>
						<p>Dynamically edit the final destination of your QRLA plaques, allowing for event changes.</p>
						<p>Customise the QRLA Safety Verification page by uploading a new logo, allowing for flexibility around different events and brand updates.</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
		<v-row class="mb-3">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Venue Performance Tracker" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="text-left gap-4 flex flex-col h-full">
						<h3 class="h3 q-text-qrla_green">What is the Venue Performance Tracker?</h3>
						<p>Track how well your QRLA plaques are performing across your entire venue with the Venue Performance Tracker.</p>
						<p>View total number of views via QRLA plaques, including breakdowns of visits by Tap or Scan.</p>
						<p>Get insights on how QRLA visits have changed over time, by viewing QRLA data across a variety of timescales.</p>
						<p>View an interactive heatmap of QRLA activity across your venue.</p>
					</div>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="flex flex-col text-left gap-4">
						<h3 class="h3">Venue Performance Tracker</h3>
						<img
							:src="QVENUEPERFORMANCEIMAGE"
							class="w-full" />
						<Link :href="route('venues.index')">
							<v-btn class="q-btn-green w-full">View Plaque Performance</v-btn>
						</Link>
					</div></QCard
				>
			</v-col>
		</v-row>
		<v-row class="mb-1">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Block Performance Tracker" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="flex flex-col text-left gap-4">
						<h3 class="h3">Block Performance Tracker</h3>
						<img
							:src="QBLOCKPERFORMANCEIMAGE"
							class="w-full" />
						<Link :href="route('venues.index')">
							<v-btn class="q-btn-green w-full">View Block Performance</v-btn>
						</Link>
					</div></QCard
				>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="text-left gap-4 flex flex-col h-full">
						<h3 class="h3 q-text-qrla_green">What is the Block Performance Tracker?</h3>
						<p>View how well your QRLA plaques are performing in specific blocks with the Block Performance Tracker.</p>
						<p>The Block Performance Tracker gives you a more detailed breakdown of where your QRLA plques are being used most in your venue.</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
