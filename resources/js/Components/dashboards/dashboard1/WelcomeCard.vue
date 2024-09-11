<script setup lang="ts">
import { Icon } from '@iconify/vue';
</script>
<template>
    <v-card elevation="10" class="bg-primary overflow-hidden">
        <v-card-item class="pb-0">
            <v-row>
                <v-col cols="12" md="7">
                    <div class="d-flex gap-3 align-center">
                        <v-avatar size="48" class="rounded-md bg-surface">
                            <Icon icon="solar:course-up-outline" class="text-textPrimary opacity-80" height="25" />
                        </v-avatar>
                        <div class="text-h4">Welcome Back David</div>
                    </div>
                    <div class="mt-xl-16 mt-lg-8 mt-6">
                        <div class="d-flex justify-space-between pr-7">
                            <div class="py-0">
                                <p class="opacity-80 mb-1">Budget</p>
                                <h3 class="text-xl-h3 text-lg-h5">$98,450</h3>
                            </div>
                            <v-divider vertical class="opacity-20 h-55"></v-divider>
                            <div class="py-0">
                                <p class="opacity-80 mb-1">Expense</p>
                                <h3 class="text-xl-h3 text-lg-h5">$2,440</h3>
                            </div>
                        </div>
                    </div>
                </v-col>
                <v-col cols="12" md="5" class="pb-0 text-md-end text-center">
                    <img src="@/assets/images/backgrounds/welcome-bg.png" alt="matdash-img" class="welcome-img " />
                </v-col>
            </v-row>
        </v-card-item>
    </v-card>
</template>
