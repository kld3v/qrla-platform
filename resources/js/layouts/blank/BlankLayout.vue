// ===============================|| Blank Layout ||=============================== //
<script setup lang="ts">
import { useCustomizerStore } from '../../stores/customizer'
const customizer = useCustomizerStore()
</script>
<template>
	<!-----LTR LAYOUT------->
	<v-locale-provider>
		<v-app :theme="customizer.actTheme">
			<slot></slot>
		</v-app>
	</v-locale-provider>
</template>
