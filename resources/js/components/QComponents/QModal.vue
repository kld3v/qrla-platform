<script setup lang="ts">
import { ref } from 'vue'
const props = defineProps<{
	buttonText: string
	totalSteps: 1 | 2 | 3
}>()

const dialog = ref(false)
const currentStep = ref(0)
const totalSteps = props.totalSteps

const nextStep = () => {
	if (currentStep.value < totalSteps - 1) {
		currentStep.value++
	}
}

const previousStep = () => {
	if (currentStep.value > 0) {
		currentStep.value--
	}
}

const save = () => {
	// Handle the save logic here
	dialog.value = false
}
</script>

<template>
	<v-dialog
		v-model="dialog"
		class="w-[1400px] h-[1200px] h-full overflow-scroll">
		<template v-slot:activator="{ props }">
			<v-btn
				color="primary"
				class="w-20"
				v-bind="props"
				flat>
				{{ buttonText }}
			</v-btn>
		</template>

		<v-card class="w-[1400px] h-full">
			<v-container>
				<!-- Page Content -->
				<div>
					<slot
						name="page-0"
						v-if="currentStep === 0"></slot>
					<slot
						name="page-1"
						v-if="currentStep === 1"></slot>
					<slot
						name="page-2"
						v-if="currentStep === 2"></slot>
				</div>

				<v-spacer></v-spacer>

				<!-- Action Buttons -->
				<div class="flex justify-space-between w-full">
					<v-btn
						v-if="currentStep < 1"
						color="error"
						@click="dialog = false"
						variant="tonal"
						flat>
						Close
					</v-btn>

					<v-btn
						color="purple"
						v-if="currentStep > 0"
						@click="previousStep"
						variant="tonal"
						flat>
						Back
					</v-btn>

					<!-- Step Indicator -->
					<div class="flex justify-center mb-6 items-center">
						<div
							v-for="step in totalSteps"
							:key="step"
							class="flex items-center">
							<div
								:class="{
									'bg-primary': currentStep >= step - 1,
									'border border-2 border-solid border-gray-300': currentStep < step - 1,
									'rounded-full h-6 w-6 flex items-center justify-center': true,
								}"></div>
							<!-- Line Between Steps -->
							<div
								v-if="step < totalSteps"
								class="h-0 w-4"></div>
						</div>
					</div>

					<v-btn
						v-if="currentStep < totalSteps - 1"
						color="primary"
						@click="nextStep"
						variant="tonal"
						flat>
						Next
					</v-btn>

					<v-btn
						v-else
						color="primary"
						@click="save"
						variant="tonal"
						flat>
						Save
					</v-btn>
				</div>
			</v-container>
		</v-card>
	</v-dialog>
</template>

<style lang="scss" scoped>
.border-2 {
	border-width: 0.1px; /* Ensure the line thickness matches the border width of the circles */
}
</style>
