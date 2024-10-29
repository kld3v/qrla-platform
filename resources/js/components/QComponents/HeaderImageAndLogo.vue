<script setup lang="ts">
import { VenuePageProps } from '@/types'

const props = defineProps<{
	bannerUrl: VenuePageProps['banner_url']
	logoUrl: VenuePageProps['logo_url']
	name: VenuePageProps['name']
	addressLine1: VenuePageProps['address_line1']
	city: VenuePageProps['city']
}>()
</script>
<template>
	<div>
		<div class="relative">
			<img
				:src="bannerUrl"
				alt="Banner"
				class="border-b-4 border-solid border-green-500 h-[300px] w-full rounded-tl-lg rounded-tr-lg object-cover" />
			<img
				:src="logoUrl"
				alt="Logo"
				class="border-4 border-solid rounded-full border-green-500 w-[240px] h-[240px] absolute top-[150px] left-[9.66%] object-cover" />
		</div>
		<div class="w-full flex flex-row mt-4 flex-wrap">
			<div class="h-[80px] w-full max-w-[420px]"></div>
			<div class="text-left flex-row flex">
				<div>
					<h1 class="text-5xl">{{ name }}</h1>
					<p class="text-lg font-light">{{ addressLine1 }}, {{ city }}</p>
				</div>
				<v-chip
					label
					color="primary"
					class="text-primary md:ml-8 w-16 flex align-center justify-center col-start-4">
					Live
				</v-chip>
			</div>
		</div>
	</div>
</template>

<style></style>
