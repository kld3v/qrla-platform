<script setup lang="ts">
import QSubsectionHeader from '@/components/custom/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/custom/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/custom/VenueTitleAndAddress.vue'
import QCard from '@/components/custom/QCard.vue'

const props = defineProps<{
	venue: VenuePageProps
}>()

const isGlobalHome = ref(false)
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
				<QSubsectionHeader title="Manage Your Plaques" />
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
				<QSubsectionHeader title="Select Your Blocks" />
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
