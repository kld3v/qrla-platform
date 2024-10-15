<script setup lang="ts">
import { ref } from 'vue'
import { QCardType, QColors } from '@/types'
const page = ref({ title: 'Data Tables Selection' })
const selected = ref()

/*Header Data*/
const headers: any = ref([{ title: 'Blocks', align: 'start', key: 'name' }])

type BlockDataObject = {
	circleColor: QColors
	code: string
	name: string
}
const props = defineProps<{
	blockData: BlockDataObject[]
}>()
</script>
<template>
	<v-data-table
		items-per-page="5"
		:headers="headers"
		:items="blockData"
		hover
		show-select
		class="border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table">
		<template v-slot:item.name="{ item }">
			<div class="flex gap-2 align-center">
				<div :class="`rounded-circle h-[24px] w-[24px] bg-${item.circleColor}`"></div>
				<p>{{ item.code }}</p>
				<p class="ml-4">{{ item.name }}</p>
			</div>
		</template>
	</v-data-table>
</template>
