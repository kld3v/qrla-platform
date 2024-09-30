<script setup lang="ts">
const props = defineProps<{
	title?: string
	subHeading?: string
	buttonText?: string
	imageSrc?: string
}>()
</script>
<template>
	<v-card
		elevation="10"
		class="max-h-100 h-100 bg-light-to-dark">
		<v-card-item class="text-center max-h-100">
			<h5
				v-if="title"
				class="text-xl pt-3 mb-0"
				style="color: #29343d">
				{{ title }}
			</h5>
			<p
				v-if="subHeading"
				class="mt-3 text-xl"
				style="color: #394236">
				{{ subHeading }}
			</p>
			<v-btn
				v-if="buttonText"
				flat
				class="mt-4 text-lg"
				size="x-large"
				color="secondary"
				>{{ buttonText }}</v-btn
			>
		</v-card-item>
	</v-card>
</template>
<style lang="scss">
.bg-light-to-dark {
	background: linear-gradient(180deg, #caf090 0.42%, #7b9257 100%) !important;
}
</style>
