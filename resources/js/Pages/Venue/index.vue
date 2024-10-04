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

const props = defineProps<{
	venue: VenuePageProps
}>()

const isGlobalHome = ref(false)

// to be relpaced with prop data
const IconCardData = [
	{
		bg: 'dark-primary-gradient',
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
					<div class="flex justify-center">
						<div class="w-1/2 flex justify-center align-center">
							<div class="text-left mr-4">
								<h3>Your Qrla Plaques!</h3>
								<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto eligendi dignissimos quod rerum sunt natus, dolorem adipisci consectetur cumque quam ut voluptate? Perspiciatis,
									praesentium illum! Dolorem adipisci voluptatum quas quos!
								</p>
								<button>Check</button>
							</div>
							<img
								:src="HorizontalPlaque"
								alt="HorizontalPlaque" />
						</div>
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
				<QCard bg="default-gray">hello </QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">hello </QCard>
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
				<QCard bg="default-gray">hello </QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">hello </QCard>
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
				<QCard bg="default-gray">hello </QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">hello </QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
