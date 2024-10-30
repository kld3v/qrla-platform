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

// Watch internal state and update parent only when there is a change
watch(
	() => internalSelectedBlocks.value,
	(newVal) => {
		if (JSON.stringify(newVal) !== JSON.stringify(props.selectedBlocks)) {
			props.updateSelectedBlockState(newVal)
			console.log('update parent state after internal change')
		}
	}
)

console.log(props.selectedBlocks)
// Watch parent state and update local only when there is a change
// this needs revisiting it feels like a complete bodge.
watch(
	() => props.selectedBlocks,
	(newVal) => {
		if (JSON.stringify(newVal) !== JSON.stringify(internalSelectedBlocks.value)) {
			internalSelectedBlocks.value = newVal
			console.log('update local state after parent change')
		}
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
			items-per-page="-1"
			:selectStrategy="selectStrategy || 'single'"
			show-select
			class="border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table datatables max-h-[600px]"
			v-model="internalSelectedBlocks"
			:return-object="true">
			<!-- Block Column -->
			<template #item.name="{ item }">
				<div class="flex gap-4 align-center">
					<div
						:class="['h-[24px]', 'w-[24px]', 'rounded-circle']"
						:style="{ backgroundColor: item.color }"></div>
					<span>{{ item.name }}</span>
				</div>
			</template>
		</v-data-table>
	</div>
</template>

<style scoped>
.rounded-circle {
	border-radius: 50%;
}
</style>
