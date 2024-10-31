<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import SideRegister from '@/views/authentication/SideRegister.vue';


interface yeahMan {
  token?: string;
  auth:any
}

//@ts-ignore
const { props } = usePage<yeahMan>();
</script>

<template>
  <SideRegister :token="props.token" />
</template>
