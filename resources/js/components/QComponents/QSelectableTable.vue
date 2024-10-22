<template>
  <div>
    <!-- Data Table -->
    <v-data-table
      :headers="headers"
      :items="blockData"
      :single-select="selectStrategy === 'single'"
      :show-select="true"
      class="border border-2 border-solid border-grey rounded-md bg-transparent block-stats-table datatables"
      v-model="selectedBlocks"
	  item-value="code"
    >
      <!-- Block Column -->
      <template #item.code="{ item }">
        <div class="flex gap-4 align-center">
          <div
            :class="[
              'h-[24px]',
              'w-[24px]',
              `bg-${item.circleColor}`,
              'rounded-circle',
            ]"
          ></div>
          <span>{{ item.code }}</span>
        </div>
      </template>

      <!-- Stand Column -->
      <template #item.name="{ item }">
        <p>{{ item.name }}</p>
      </template>
    </v-data-table>

    <!-- Selected Block Data for Debugging -->
    <v-card class="elevation-0 border mt-3 pa-4">
      <pre>{{ selectedBlocks }}</pre>
    </v-card>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

interface Block {
  code: string;
  name: string;
  circleColor: string;
}

const props = defineProps<{
  blockData: Block[];
  updateSelectedBlock: (block: Block | null) => void;
  selectStrategy: 'single' | 'all' | 'page';
}>();

const selectedBlocks = ref<Block[]>([]);

const headers = ref([
  { title: 'Block', align: 'start', key: 'code' },
  { title: 'Stand', align: 'start', key: 'name' },
]);

watch(
  selectedBlocks,
  (newVal) => {
    const firstSelectedBlock = newVal.length > 0 ? newVal[0] : null;
    props.updateSelectedBlock(firstSelectedBlock);
  },
  { immediate: true }
);
</script>

<style scoped>
.rounded-circle {
  border-radius: 50%;
}
</style>
