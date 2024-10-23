<script setup lang="ts">
import { ref, watch } from 'vue';
import { BlockExtended } from '@/types';

const props = defineProps<{
  selectedBlocks: BlockExtended[];
  blockData: BlockExtended[];
  selectStrategy: 'single' | 'all' | 'page';
  updateSelectedBlockState: (blocks: BlockExtended[]) => void;
}>();

const internalSelectedBlocks = ref<BlockExtended[]>(props.selectedBlocks);
let updatingFromProps = false; // Add this flag

watch(
  () => props.selectedBlocks,
  (newVal) => {
    updatingFromProps = true;
    internalSelectedBlocks.value = newVal;
    updatingFromProps = false;
  }
);

watch(
  () => internalSelectedBlocks.value,
  (newVal) => {
    if (!updatingFromProps) {
      props.updateSelectedBlockState(newVal);
    }
  }
);
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
