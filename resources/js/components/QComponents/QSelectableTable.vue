<script setup lang="ts">
import { ref, watch } from 'vue'
import { QColors } from '@/types'
const selected = ref()

/*Header Data*/
const headers: any = ref([
	{ title: 'Block', align: 'start', key: 'code' },
	{ title: 'Stand', align: 'start', key: 'name' },
])

type BlockDataObject = {
	circleColor: QColors
	code: string
	name: string
}
const props = defineProps<{
	blockData: BlockDataObject[]
	selectStrategy?: 'single' | 'all' | 'page'
	updateSelectedBlock: (blockId: number) => void
}>()

watch(
	() => selected.value,
	() => {
		props.updateSelectedBlock(selected.value[0].id)
	}
)
</script>
<template>
	<v-data-table
		items-per-page="5"
		:headers="headers"
		:items="blockData"
		return-object
		show-select
		:select-strategy="selectStrategy ? selectStrategy : 'single'"
		:itemsPerPageOptions="[5, 10, 25]"
		v-model="selected"
		class="border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table datatables">
		<template v-slot:item.code="{ item }">
			<div class="flex gap-4 align-center">
				<div :class="`rounded-circle h-[24px] w-[24px] bg-${item.circleColor}`"></div>
				<p>{{ item.code }}</p>
			</div>
		</template>
		<template v-slot:item.name="{ item }">
			<div class="">
				<p class="">{{ item.name }}</p>
			</div>
		</template>
	</v-data-table>
	<v-card class="elevation-0 border mt-3 pa-4">
		<pre>{{ selected }}</pre>
	</v-card>
</template>
