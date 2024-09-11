<script setup lang="ts">
import { Icon } from '@iconify/vue';
</script>
<template>
    <v-card elevation="10" class="bg-primary-gt position-relative profit-card overflow-hidden">
        <v-card-item > 
            <div class="d-flex rounded-sm gap-2 align-center badge-custom-dark text-white">
                <Icon icon="solar:check-circle-outline" height="18"/> 
                This month <strong>+15% Profit</strong>   
            </div>
            <div class="pt-6 mt-12">
               <h3 class="text-h3 text-white mb-2">Hey, David McMichael</h3>
               <p class="opacity-80 mb-1 text-white text-subtitle-1">Aenean vel libero id metus sollicitudin</p>
            </div>
        </v-card-item>
        <img src="@/assets/images/backgrounds/welcome-bg2.png" alt="matdash-img" class="position-absolute" />
    </v-card>
</template>
