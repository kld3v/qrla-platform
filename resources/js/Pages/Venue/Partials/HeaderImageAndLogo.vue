<script setup lang="ts">
import { VenuePageProps } from '@/types/Venue'

const props = defineProps<{
	bannerUrl: VenuePageProps['banner_url']
	logoUrl: VenuePageProps['logo_url']
}>()
</script>
<template>
	<div class="relative">
		<img
			:src="bannerUrl"
			alt="Banner"
			class="border-2 border-solid border-green-500 h-[300px]" />
		<img
			:src="logoUrl"
			alt="Logo"
			class="border-2 border-solid rounded-full border-green-500 w-[300px] h-[300px] absolute top-[150px] left-[18.66%]" />
	</div>
</template>

<style></style>
