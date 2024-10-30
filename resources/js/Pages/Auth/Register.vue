<script setup lang="ts">
import SideRegister from '@/views/authentication/SideRegister.vue'
</script>

<template>
	<SideRegister :token="page.props.token" />
</template>
