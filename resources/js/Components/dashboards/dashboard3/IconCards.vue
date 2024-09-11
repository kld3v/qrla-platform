<script setup lang="ts">
import { IconcardData } from '@/_mockApis/components/dashboard/dashboard3';
import { Icon } from '@iconify/vue';
import type { computed } from 'vue';
</script>

<template>
    <v-card elevation="10" class="overflow-hidden">
        <v-card-item>
            <div class="d-flex gap-4 flex-wrap">
                <div v-for="card in IconcardData" :key="card.bg" class="flex-1-0">
                    <v-sheet :class="card.bg" class="py-8 px-3 rounded-md text-center">
                        <v-avatar size="48" :color="card.color" class="rounded-md mb-3">
                            <Icon :icon="card.icon" height="25" />
                        </v-avatar>
                        <p class="mb-1">{{ card.title }}</p>
                        <h3 class="text-h3 heading mb-5">{{ card.price }}</h3>
                        <RouterLink
                            :to="card.link"
                            class="bg-surface mt-3 rounded-sm text-decoration-none text-body-2 font-weight-semibold btn-white elevation-9"
                            >View Details</RouterLink
                        >
                    </v-sheet>
                </div>
            </div>
        </v-card-item>
    </v-card>
</template>
