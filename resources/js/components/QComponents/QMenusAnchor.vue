<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
	menuLocation: 'top' | 'bottom' | 'start' | 'end' | 'center'
	dropdownButtonColor: string
	dropdownOptions: string[]
}>()

const option = ref()
const items = ref([{ title: 'Click Me' }, { title: 'Click Me' }, { title: 'Click Me' }, { title: 'Click Me 2' }])

const locations = ref(['top', 'bottom', 'start', 'end', 'center'])
const location = ref('Sept 2023')
</script>

<template>
	<div class="text-center mt-4 w-[180px]">
		<v-select
			v-model="location"
			:items="locations"
			label="Location"></v-select>
	</div>
</template>
