<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { VenuePageProps } from '@/types'
import QIconCardSet from '@/components/QComponents/QIconCardSet.vue'
import QCard from '@/components/QComponents/QCard.vue'
import HorizontalPlaque from '@/assets/images/QAssets/chelspng 1horizontal_plaque.png'
import QCARDSTADICON from '@/assets/images/QAssets/Venues/stadium.svg'
import QCARDLEVYICON from '@/assets/images/QAssets/Venues/levy.svg'
import QCARDSOCCERICON from '@/assets/images/QAssets/Venues/soccer_logo.svg'
import QCARDQRLAICON from '@/assets/images/QAssets/Venues/qrla_logo.svg'
import QCARDSALESICON from '@/assets/images/QAssets/Venues/sales.svg'
import QPLAQUEMANAGEMENTDASHBOARDIMAGE from '@/assets/images/QAssets/Venues/asset1.png'
import QVENUEPERFORMANCEIMAGE from '@/assets/images/QAssets/Venues/asset2.png'
import QBLOCKPERFORMANCEIMAGE from '@/assets/images/QAssets/Venues/asset3.png'
import { Link } from '@inertiajs/vue3'
import { Icon } from '@iconify/vue'
import { NavOptions } from '@/types'

const props = defineProps<{
	venue: VenuePageProps
	nav: NavOptions
	stats: any
}>()

console.log(props)

const { capacity, type, plaques, access_rate } = props.venue
// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'dark-primary-gradient',
		color: 'primary',
		title: 'Venue Capacity',
		data: capacity,
		link: '',
		image: QCARDSTADICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'warning',
		title: 'Venue Type',
		data: type,
		link: '',
		image: QCARDSOCCERICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'secondary',
		title: 'QRLA Plaques',
		data: plaques,
		link: '',
		image: QCARDQRLAICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'error',
		title: 'Managed By',
		data: props.venue.organisation.name,
		link: '',
		image: QCARDLEVYICON,
	},
	{
		bg: 'dark-primary-gradient',

		color: 'success',
		title: 'Activity Level',
		data: parseFloat(access_rate).toFixed(1) + '%',
		link: '',
		image: QCARDSALESICON,
	},
]
</script>
<template>
	<FullLayout
		:isGlobalHome="false"
		:venue="venue"
		:nav="nav">
		<HeaderImageAndLogo
			:bannerUrl="venue.banner_url"
			:logoUrl="venue.logo_url"
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
							<h3 class="h3">Your QRLA Plaques!</h3>
							<p
								class="h3"
								style="font-weight: 100">
								Your plaques have been scanned a total of {{ stats.accesses }} times at {{ venue.name }}!
							</p>
							<Link
								:href="
									route('blocks.index', {
										venue: props.venue.id,
									})
								">
								<v-btn class="bg-primary w-1/4">Check</v-btn>
							</Link>
						</div>
						<img
								:src="venue.plaque_image_url"
								class="h-full mt-2 max-w-[500px]"
								alt="Plaque Image" />
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
						<Link :href="route('blocks.index', { venue: venue.id })">
							<v-btn class="bg-primary w-full">Manage Plaques</v-btn>
						</Link>
					</div>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="text-left gap-4 flex flex-col h-full">
						<div class="flex justify-space-between align-center">
							<h3 class="h3 q-text-qrla_green">What is the QRLA management dashboard?</h3>
							<Icon
								icon="heroicons:squares-plus"
								height="25"
								class="text-primary" />
						</div>

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
						<div class="flex justify-space-between align-center">
							<h3 class="h3 q-text-qrla_green">What is the Venue Performance Tracker?</h3>
							<Icon
								icon="ph:chart-line-up"
								height="25"
								class="text-primary" />
						</div>
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
						<Link :href="route('venues.showStats', { venue: venue.id })">
							<v-btn class="bg-primary w-full">View Plaque Performance</v-btn>
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
						<Link
							:href="
								route('blocks.showStats', {
									venue: venue.id,
								})
							">
							<v-btn class="bg-primary w-full">View Block Performance</v-btn>
						</Link>
					</div></QCard
				>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="text-left gap-4 flex flex-col h-full">
						<div class="flex justify-space-between align-center">
							<h3 class="h3 q-text-qrla_green">What is the Block Performance Tracker?</h3>
							<Icon
								icon="material-symbols:stairs-outline"
								height="25"
								class="text-primary" />
						</div>
						<p>View how well your QRLA plaques are performing in specific blocks with the Block Performance Tracker.</p>
						<p>The Block Performance Tracker gives you a more detailed breakdown of where your QRLA plques are being used most in your venue.</p>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
