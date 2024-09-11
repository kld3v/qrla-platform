<script setup lang="ts">
import { userCardData } from '@/_mockApis/components/dashboard/dashboard2';
</script>

<template>
    <v-card elevation="10" class="overflow-hidden">
        <img src="@/assets/images/backgrounds/blog.jpg" alt="matdash-image" class="w-100" />
        <v-card-item class="pt-6">
            <v-card-title class="text-h5">Figma tips and tricks with Stephan</v-card-title>
            <p class="text-15 text-muted my-3">
                Nullam lobortis sodales dolor vitae viverra. Cras lacinia bibendum metus vel rhoncus.
            </p>
            <div class="d-flex justify-content-start mt-4">
                <div class="ml-2 d-flex">
                    <v-avatar v-for="card in userCardData" :key="card.img" size="40" class="ml-n2 avtar-border">
                        <img :src="card.img" alt="usericon" height="40" />
                    </v-avatar>
                    <v-avatar size="40" class="ml-n2 avtar-border text-primary font-weight-medium" color="lightprimary">
                        +12
                    </v-avatar>
                </div>
            </div>
        </v-card-item>
    </v-card>
</template>
