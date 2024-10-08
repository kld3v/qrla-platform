<script setup lang="ts">
import { IconcardData } from '@/_mockApis/components/dashboard/dashboard3'
import { Icon } from '@iconify/vue'
import { computed } from 'vue'

type IconCardObject = {
	bg: string
	icon?: string
	color?: string
	title: string
	data: any
	link: string
	image?: string
}
const props = defineProps<{
	bg: string
	IconCardData: IconCardObject[]
}>()

// TODO this will be passed as props eventually.

const bgClass = computed(() => {
	return props.bg ? `bg-[${props.bg}]` : ''
})

const colsLength = computed(() => {
	return props.IconCardData.length
})
</script>

<template>
	<v-card
		elevation="10"
		class="overflow-hidden">
		<v-card-item :class="bgClass">
			<div :class="`grid grid-cols-${colsLength} gap-4`">
				<div
					v-for="card in props.IconCardData"
					:key="card.bg"
					class="flex-1-0">
					<v-sheet
						:class="card.bg"
						class="py-8 px-3 rounded-md text-center !flex flex-col align-center justify-center h-full">
						<v-avatar
							v-if="card.icon"
							size="48"
							:color="card.color"
							class="rounded-md mb-3">
							<Icon
								:icon="card.icon"
								height="25" />
						</v-avatar>
						<img
							v-if="card.image"
							:src="card.image"
							alt="Image"
							class="h-[80px] mb-4" />
						<p class="mb-1">{{ card.title }}</p>
						<h3 class="text-h3 heading mb-5">{{ card.data }}</h3>
						<Link
							v-if="card.link"
							:href="card.link"
							class="bg-surface mt-3 rounded-sm text-decoration-none text-body-2 font-weight-semibold btn-white elevation-9"
							>View Details</Link
						>
					</v-sheet>
				</div>
			</div>
		</v-card-item>
	</v-card>
</template>

<style lang="scss" scoped>
.primary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-primary), 0.12) 0, rgba(var(--v-theme-primary), 0.03) 100%);
}

.warning-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-warning), 0.12) 0, rgba(var(--v-theme-warning), 0.03) 100%);
}

.secondary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-secondary), 0.12) 0, rgba(var(--v-theme-secondary), 0.03) 100%);
}

.error-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-error), 0.12) 0, rgba(var(--v-theme-error), 0.03) 100%);
}

.success-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-success), 0.12) 0, rgba(var(--v-theme-success), 0.03) 100%);
}

.dark-primary-gradient {
	background: linear-gradient(180deg, rgba(var(--v-theme-darkprimary), 0.2) 0, rgba(var(--v-theme-darkprimary), 0.05) 100%);
}
</style>
