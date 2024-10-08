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
		icon: 'solar:recive-twice-square-linear',
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
							lg="4">
							<v-avatar
								size="48"
								class="rounded-md q-primary-gradient">
								<Icon
									icon="solar:layers-linear"
									class="text-primary"
									height="25" />
							</v-avatar>
						</v-col>
					</v-row>
				</QCard>
			</v-col>
		</v-row>

		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray"> </QCard>
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCard bg="default-gray"> </QCard>
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
