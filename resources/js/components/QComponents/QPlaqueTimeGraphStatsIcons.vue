<template>
	<div class="flex flex-col gap-y-8">
		<div class="flex flex-row">
			<v-avatar
				size="48"
				class="rounded-md q-primary-gradient">
				<Icon
					icon="streamline:wave-signal-solid"
					class="text-primary"
					height="25" />
			</v-avatar>
			<div class="ml-2">
				<p>Total</p>
				<p class="q-text-qrla_green font-bold">1126</p>
			</div>
		</div>
		<div class="flex flex-row">
			<v-avatar
				size="48"
				class="rounded-md q-primary-gradient">
				<Icon
					icon="lucide:nfc"
					class=""
					style="color: #635bff"
					height="25" />
			</v-avatar>
			<div class="ml-2">
				<p>Taps</p>
				<p class="q-text-qrla_green font-bold">1126</p>
			</div>
		</div>
		<div class="flex flex-row">
			<v-avatar
				size="48"
				class="rounded-md q-primary-gradient">
				<Icon
					icon="uil:qrcode-scan"
					class="text-success"
					height="25" />
			</v-avatar>
			<div class="ml-2">
				<p>Scans</p>
				<p class="q-text-qrla_green font-bold">1126</p>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>

<style></style>
