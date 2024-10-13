<script setup lang="ts">
import { VenuePageProps } from '@/types/Venue'

const props = defineProps<{
	name: VenuePageProps['name']
	addressLine1: VenuePageProps['address_line1']
	city: VenuePageProps['city']
}>()
</script>
<template>
	<div class="w-full grid grid-cols-12">
		<div class="text-left col-start-4 col-span-3 ml-8">
			<h1 class="text-5xl">{{ name }}</h1>
			<p class="text-lg font-light">{{ addressLine1 }}, {{ city }}</p>
		</div>

		<v-chip
			label
			color="primary"
			class="text-primary ml-8 w-16 flex align-center justify-center">
			Live
		</v-chip>
	</div>
</template>

<style></style>
