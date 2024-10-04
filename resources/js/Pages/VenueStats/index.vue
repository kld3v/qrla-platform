<script setup lang="ts">
import QSubsectionHeader from '@/components/custom/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/custom/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/custom/VenueTitleAndAddress.vue'
import QCard from '@/components/custom/QCard.vue'
import QIconCardSet from '@/components/custom/QIconCardSet.vue'

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
		bg: 'dark-primary-gradient',
		icon: 'solar:recive-twice-square-linear',
		color: 'warning',
		title: 'Venue Type',
		data: 'Sport',
		link: '',
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:outline-backpack',
		color: 'secondary',
		title: 'QRLA Plaques',
		data: '450',
		link: '',
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:baseline-sync-problem',
		color: 'error',
		title: 'Managed By',
		data: 'Levy UK & Ireland',
		link: '',
	},
	{
		bg: 'dark-primary-gradient',
		icon: 'ic:outline-forest',
		color: 'success',
		title: 'Activity Level',
		data: '+86%',
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
	</FullLayout>
</template>
