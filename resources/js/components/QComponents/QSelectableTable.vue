<script setup lang="ts">
import { ref, watch } from 'vue';

interface Block {
  id: number;
  code: string;
  name: string;
  circleColor: string;
}

const props = defineProps<{
  blockData: Block[];
  selectStrategy: 'single' | 'all' | 'page';
  modelValue: Block[];
}>();

const emits = defineEmits(['update:modelValue']);

const internalSelectedBlocks = ref<Block[]>(props.modelValue || []);

watch(
  () => internalSelectedBlocks.value,
  (newVal) => {
    console.log('DataTable Selection Changed:', newVal);
    emits('update:modelValue', newVal);
  },
  { immediate: true }
);

const headers = ref([
  { title: 'Block', align: 'start', key: 'name' },
  { title: 'Stand', align: 'start', key: 'code' },
]);
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
      :return-object="true"
    >
      <!-- Block Column -->
      <template #item.name="{ item }">
        <div class="flex gap-4 align-center">
          <div
            :class="[
              'h-[24px]',
              'w-[24px]',
              `bg-${item.circleColor}`,
              'rounded-circle',
            ]"
          ></div>
          <span>{{ item.name }}</span>
        </div>
      </template>

      <!-- Stand Column -->
      <template #item.code="{ item }">
        <p>{{ item.code }}</p>
      </template>
    </v-data-table>
  </div>
</template>

<style scoped>
.rounded-circle {
  border-radius: 50%;
}
</style>
