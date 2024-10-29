<template>
	<div class="loading-container">
		<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="-10 -10 220 220"
			width="140"
			height="140"
			fill="none">
			<!-- Outer Ripple Wave -->
			<circle
				cx="100"
				cy="100"
				r="90"
				stroke="#A2F732"
				stroke-width="4"
				opacity="0.4">
				<animate
					attributeName="r"
					values="90;110;90"
					dur="2.5s"
					repeatCount="indefinite"
					keyTimes="0;0.5;1" />
				<animate
					attributeName="opacity"
					values="0.4;0;0.4"
					dur="2.5s"
					repeatCount="indefinite" />
			</circle>

			<!-- Rotating Dash Circle -->
			<circle
				cx="100"
				cy="100"
				r="60"
				stroke="#FFAE1F"
				stroke-width="8"
				stroke-dasharray="377"
				stroke-dashoffset="0">
				<animateTransform
					attributeName="transform"
					type="rotate"
					from="0 100 100"
					to="360 100 100"
					dur="3s"
					repeatCount="indefinite" />
				<animate
					attributeName="stroke"
					values="#FFAE1F;#635BFF;#3CACC8;#A2F732"
					dur="6s"
					repeatCount="indefinite" />
			</circle>

			<!-- Color-changing Inner Circle -->
			<circle
				cx="100"
				cy="100"
				r="35"
				stroke-width="6"
				stroke="#14E9E2">
				<animate
					attributeName="stroke"
					values="#14E9E2;#635BFF;#FF6692;#FFAE1F"
					dur="3s"
					repeatCount="indefinite" />
			</circle>

			<!-- Morphing Central Shape -->
			<path
				:d="shapePath"
				fill="#635BFF">
				<animate
					attributeName="d"
					values="
            M 90 100 Q 100 90 110 100 Q 100 110 90 100 Z;  <!-- Circle -->
            M 85 85 L 115 85 L 115 115 L 85 115 Z;  <!-- Square -->
            M 100 70 L 130 130 L 70 130 Z"
					dur="2.4s"
					repeatCount="indefinite" />
				<animate
					attributeName="fill"
					values="#635BFF;#A2F732;#3CACC8;#FF6692"
					dur="2.4s"
					repeatCount="indefinite" />
			</path>
		</svg>
		<p class="q-text-qrla_green">Compiling Data...</p>
	</div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

// Define paths for morphing shapes (circle, square, triangle)
const shapePath = ref('M 90 100 Q 100 90 110 100 Q 100 110 90 100 Z')
</script>

<style scoped>
.loading-container {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	gap: 8px;
	height: 400px; /* Matches the card height */
}
</style>

<script setup lang="ts"></script>
