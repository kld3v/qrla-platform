<script setup lang="ts">
import { ref, watch } from 'vue'

const props = defineProps<{
	menuLocation: 'top' | 'bottom' | 'start' | 'end' | 'center'
	dropdownButtonColor: string
	dropdownOptions: string[]
	label: string
	initialSelectedItem: any
	changeSelectedStand?: (standName: string) => void
}>()

const location = ref(props.initialSelectedItem)

watch(
	() => location.value,
	() => {
		if (props.changeSelectedStand) props.changeSelectedStand(location.value)
	}
)
</script>

<template>
	<div class="text-center mt-4 w-[180px]">
		<v-select
			v-model="location"
			:items="dropdownOptions"
			:label="label"></v-select>
	</div>
</template>
