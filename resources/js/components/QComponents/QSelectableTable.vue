<script setup lang="ts">
import { computed, ref, watch } from 'vue'
import { BlockExtended } from '@/types'

const props = defineProps<{
	// The data in Mr Selected Blocks - ie the data the user has selected.
	selectedBlocks: BlockExtended[]
	// All the data that Mr Table wants to show available to the user to click.
	blockData: BlockExtended[]
	selectStrategy: 'single' | 'all' | 'page'
	updateSelectedBlockState: (blocks: BlockExtended[]) => void
	compact?: boolean
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
>([
	{ title: 'Block Name', align: 'start', key: 'name' },
	{ title: 'Current URL', align: 'start', key: 'url' },
])
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
			:class="['border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table datatables max-h-[600px]', compact ? 'compact' : '']"
			v-model="internalSelectedBlocks"
			:return-object="true">
			<!-- Block Column -->
			<template #item.name="{ item }">
				<div class="flex gap-2 align-center">
					<div
						:class="['h-[20px]', 'w-[20px]', 'rounded-circle']"
						:style="{ backgroundColor: item.color }"></div>
					<span>{{ item.name }}</span>
				</div>
			</template>
			<template #item.url="{ item }">
				<div class="flex gap-2 align-center">
					<p>{{ item.redirect.base_url.url }}</p>
				</div>
			</template>
		</v-data-table>
	</div>
</template>

<style scoped>
.rounded-circle {
	border-radius: 50%;
}

/* Compact table styling */
.compact-table .v-data-table__wrapper {
	padding: 0;
}

.compact-table .v-data-table__wrapper td,
.compact-table .v-data-table__wrapper th {
	padding: 4px 8px; /* Adjust these values to reduce spacing */
}

.compact-table .v-data-table__wrapper .flex {
	gap: 2px; /* Reduces gap between elements within cells */
}
</style>
