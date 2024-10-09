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
				lg="6">
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
								<ul>
									<li>AppleiOS</li>
									<li>Android</li>
								</ul>
							</QCard>
						</v-col>
					</v-row>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCard
					bg="default-gray"
					class="text-left">
					<h3 class="q-text-qrla_green h3">Browser Stats</h3>
					<p class="text-subtitle-1">Most used browsers by customers.</p>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCard bg="default-gray"> </QCard>
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QCard bg="default-gray"> </QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
