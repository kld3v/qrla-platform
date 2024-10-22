<script setup lang="ts">
import { ref, watch } from 'vue'
import { BlockExtended } from '@/types'

const props = defineProps<{
	// The data in Mr Selected Blocks - ie the data the user has selected.
	selectedBlocks: BlockExtended[]
	// All the data that Mr Table wants to show available to the user to click.
	blockData: BlockExtended[]
	selectStrategy: 'single' | 'all' | 'page'
	updateSelectedBlockState: (blocks: BlockExtended[]) => void
}>()

const internalSelectedBlocks = ref<BlockExtended[]>(props.selectedBlocks)

watch(
	() => internalSelectedBlocks.value,
	(newVal) => {
		props.updateSelectedBlockState(newVal)
	}
)

watch(
	() => props.selectedBlocks,
	(newVal) => {
		internalSelectedBlocks.value = newVal
	}
)

const headers = ref<
	{
		title: string
		align: 'start' | 'end'
		key: string
	}[]
>([{ title: 'Block Name', align: 'start', key: 'name' }])
</script>

<template>
	<div>
		<!-- Data Table -->
		<v-data-table
			:headers="headers"
			:items="blockData"
			:single-select="selectStrategy === 'single'"
			:show-select="true"
			class="border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table datatables"
			v-model="internalSelectedBlocks"
			:return-object="true">
			<!-- Block Column -->
			<template #item.name="{ item }">
				<div class="flex gap-4 align-center">
					<div :class="['h-[24px]', 'w-[24px]', `bg-primary`, 'rounded-circle']"></div>
					<span>{{ item.name }}</span>
				</div>
			</template>
		</v-data-table>
		<div>
			{{ internalSelectedBlocks }}
		</div>
	</div>
</template>

<style scoped>
.rounded-circle {
	border-radius: 50%;
}
</style>
