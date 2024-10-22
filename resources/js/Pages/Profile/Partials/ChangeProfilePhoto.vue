<template>
	<div class="flex align-center justify-center h-[90%]">
		<div class="flex flex-col justify-space-between align-center w-full h-[300px]">
			<v-avatar
				v-if="$page.props.auth.user"
				size="156">
				<img
					:src="QCARDAVATAR"
					alt="avatar"
					width="156" />
			</v-avatar>
			<div class="flex justify-space-between w-1/3">
				<v-btn
					size="large"
					color="primary"
					>Upload</v-btn
				>
				<v-btn
					size="large"
					color="error"
					>Reset</v-btn
				>
			</div>
			<p class="muted">Allowed JPG, GIF or PNG. Max size of 800K</p>
		</div>
	</div>
</template>

<script setup lang="ts">
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
const props = defineProps<{
	index: number
	componentTitle: string
}>()
console.log(props)
</script>

<style></style>
