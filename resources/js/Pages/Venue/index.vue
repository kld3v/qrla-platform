<script setup lang="ts">
import BaseBreadcrumb from '@/components/shared/BaseBreadcrumb.vue'
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
			<BaseBreadcrumb title="Venue Home" />
		</v-row>
		<v-row class="mb-6">
			<QIconCardSet />
		</v-row>
		<v-row class="mb-6">
			<QCard bg="primary-gradient">
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
		</v-row>
		<v-row class="mb-6">
			<BaseBreadcrumb title="QRLA Management Dashboard" />
		</v-row>
	</FullLayout>
</template>
