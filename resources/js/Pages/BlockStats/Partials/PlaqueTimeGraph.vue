<template>
	<QCard bg="default-gray">
		<QGraphTimeScaleMenu class="flex gap-6 absolute right-20" />
		<v-row>
			<v-col
				cols="12"
				lg="8"
				class="text-left flex flex-col gap-y-2">
				<h3 class="q-text-qrla_green h3">QRLA Plaque Activity</h3>
				<p class="text-subtitle-1">Overview of Tap or Scans through plaques</p>
				<QPlaqueActivityGraph />
			</v-col>
		</v-row>
	</QCard>
</template>

<script setup lang="ts">
import QCard from '@/components/QComponents/QCard.vue'
import QGraphTimeScaleMenu from '@/components/QComponents/QGraphTimeScaleMenu.vue'
import QPlaqueActivityGraph from '@/components/QComponents/QPlaqueActivityGraph.vue'
</script>

<style></style>
