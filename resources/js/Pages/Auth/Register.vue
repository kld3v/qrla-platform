<script setup lang="ts">
import { usePage } from '@inertiajs/vue3' 
import { onMounted } from 'vue'
import SideRegister from '@/views/authentication/SideRegister.vue'

const { props } = usePage() 

onMounted(() => {
  console.log('SideRegister component mounted.', { token: props.token });
});
</script>

<template>
    <SideRegister :token="props.token" />
</template>
