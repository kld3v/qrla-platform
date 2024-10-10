<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
	<v-card
		elevation="10"
		class="bg-primary-gt profit-card overflow-hidden h-100">
		<v-card-item>
			<div class="d-flex rounded-sm gap-2 align-center badge-custom-dark text-white">
				<Icon
					icon="solar:check-circle-outline"
					height="18" />
				This month <strong>+15% Plaque Visits</strong>
			</div>
			<div class="pt-6 mt-12">
				<h3 class="text-[56px] text-white mb-2">Hello, {{ $page.props.auth.user.name }}</h3>
				<p class="opacity-80 mb-1 text-white text-subtitle-1">Welcome to the QRLA dashboard.</p>
			</div>
		</v-card-item>
		<img
			src="@/assets/images/QAssets/LOGO.png"
			alt="matdash-img"
			class="absolute top-[18%] mr-4" />
	</v-card>
</template>
