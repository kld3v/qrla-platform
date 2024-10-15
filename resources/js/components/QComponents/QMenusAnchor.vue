<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
	menuLocation: 'top' | 'bottom' | 'start' | 'end' | 'center'
	dropdownButtonColor: string
	dropdownOptions: string[]
	label: string
}>()

const option = ref()
const items = ref([{ title: 'Click Me' }, { title: 'Click Me' }, { title: 'Click Me' }, { title: 'Click Me 2' }])

const location = ref(props.dropdownOptions[0])
</script>

<template>
	<div class="text-center mt-4 w-[180px]">
		<v-select
			v-model="location"
			:items="dropdownOptions"
			:label="label"></v-select>
	</div>
</template>
