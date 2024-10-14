<script setup lang="ts">
import { Icon } from '@iconify/vue';
</script>
<template>
    <v-card elevation="10" class="bg-primary-gt position-relative profit-card overflow-hidden">
        <v-card-item>
            <v-row>
                <v-col cols="12" md="6">
                    <h5 class="text-h5 text-white mb-4">Welcome back David!</h5>
                    <p class="opacity-80 mb-1 text-white text-body-1 lh-md">You have earned 54% more than last month which is great thing.</p>
                    <v-btn flat color="error" size="large" class="mt-4">check</v-btn>    
                </v-col>
            </v-row>
        </v-card-item>
        <img src="@/assets/images/backgrounds/welcome-bg2.png" alt="matdash-img" class="position-absolute" />
    </v-card>
</template>
