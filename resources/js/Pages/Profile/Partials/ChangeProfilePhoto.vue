<template>
	<div class="flex flex-col justify-space-between align-center w-1/3 h-full">
		<v-avatar
			v-if="$page.props.auth.user"
			size="96">
			<img
				:src="QCARDAVATAR"
				alt="avatar"
				width="96" />
		</v-avatar>
		<div class="flex justify-space-between w-full">
			<v-btn color="primary">Upload</v-btn>
			<v-btn color="error">Reset</v-btn>
		</div>
		<p class="muted">Allowed JPG, GIF or PNG. Max size of 800K</p>
	</div>
</template>

<script setup lang="ts">
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
const props = defineProps<{
	index: number
}>()
console.log(props.index)
</script>

<style></style>
