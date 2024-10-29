<script setup lang="ts">
import SideLogin from '@/views/authentication/SideLogin.vue'

defineProps<{
	canResetPassword?: boolean
	status?: string
}>()
</script>

<template>
	<SideLogin
		:can-reset-password="canResetPassword"
		:status="status" />
</template>
