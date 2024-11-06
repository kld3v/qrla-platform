<template>
  <div class="mb-4">
    <div class="flex justify-space-between">
      <div>
        <p class="h2">Block {{ blockName }}</p>
        <p class="h4">{{ visits }} Visits</p>
      </div>
      <p class="h4 align-self-end">{{ percentOfTotal }}%</p>
    </div>
    <div class="h-[8px] rounded-md mt-1 bg-white">
      <div
        class="rounded-md h-[8px]"
        :style="{
          width: `${getPercentageOfHighestPercentage}%`,
          backgroundColor: progressBarColor,
        }"
      ></div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
  visits: number
  percentOfTotal: number
  progressBarColor: string
  blockName: string
  highestPercentage: number
}>()

const getPercentageOfHighestPercentage = computed(() => {
  return (props.visits / props.highestPercentage) * 100
})
</script>
