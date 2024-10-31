<script setup lang="ts">
import { usePage } from '@inertiajs/vue3' 
import SideRegister from '@/views/authentication/SideRegister.vue'

const { props } = usePage() 

</script>

<template>
    <SideRegister :token="props.token" />
</template>
