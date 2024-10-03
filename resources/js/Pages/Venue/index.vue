<script setup lang="ts">
import BaseBreadcrumb from '@/components/shared/BaseBreadcrumb.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from './Partials/HeaderImageAndLogo.vue'
import { ref } from 'vue'
import { VenuePageProps } from '@/types/Venue'
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
		<v-row class="mb-6">
			<BaseBreadcrumb title="Venue Home" />
		</v-row>
	</FullLayout>
</template>
