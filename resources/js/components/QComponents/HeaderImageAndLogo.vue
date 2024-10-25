<script setup lang="ts">
import { VenuePageProps } from '@/types'

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
			class="border-b-4 border-solid border-green-500 h-[300px] w-full rounded-tl-lg rounded-tr-lg" />
		<img
			:src="logoUrl"
			alt="Logo"
			class="border-4 border-solid rounded-full border-green-500 w-[240px] h-[240px] absolute top-[150px] left-[9.66%]" />
	</div>
</template>

<style></style>
