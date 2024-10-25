<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
	title?: string
	subHeading?: string
	buttonText?: string
	imageSrc?: string
	hideButton?: boolean
}>()
</script>
<template>
	<v-card
		elevation="10"
		class="max-h-100 h-100 bg-light-to-dark">
		<v-card-item class="text-center h-100">
			<v-avatar
				v-if="imageSrc"
				size="96">
				<img
					:src="imageSrc"
					alt="avatar"
					width="96" />
			</v-avatar>
			<h5
				v-if="title"
				class="text-[24px] mt-2 mb-0"
				style="color: #29343d">
				{{ title }}
			</h5>
			<p
				v-if="subHeading"
				class="text-[24px] mt-2"
				style="color: #394236">
				{{ subHeading }}
			</p>
			<Link :href="route('profile.edit')">
				<v-btn
					v-if="buttonText && !hideButton"
					flat
					class="text-lg w-100 mt-6"
					size="large"
					color="#013940"
					>{{ buttonText }}</v-btn
				></Link
			>
		</v-card-item>
	</v-card>
</template>
<style lang="scss">
.bg-light-to-dark {
	background: linear-gradient(180deg, #caf090 0.42%, #7b9257 100%) !important;
}
</style>
