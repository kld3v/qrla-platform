<template>
	<div class="flex flex-col justify-center w-full px-8">
		<h3 class="h3">Enter New Destination URL</h3>
		<v-text-field
			v-model="inputValue"
			@input="updateParent"></v-text-field>
	</div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const props = defineProps<{
	modelValue: string // Passed from the parent component
}>()

const emit = defineEmits(['update:modelValue'])

const inputValue = ref(props.modelValue)

// Emit event when the input changes to update the parent state
const updateParent = () => {
	emit('update:modelValue', inputValue.value)
}
</script>

<style scoped></style>
