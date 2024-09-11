<script setup lang="ts">
import { listFeature } from '@/_mockApis/landingpage/lpPage';
import { Icon } from '@iconify/vue';
</script>
<template>
    <div class="py-sm-12 py-10">
        <v-container>
            <div class="maxWidth">
                <v-row class="justify-center">
                    <v-col cols="12" sm="6">
                        <p class="text-body-1 text-primary text-center font-weight-medium">ALMOST COVERED EVERYTHING</p>
                        <h2 class="sectionTitle text-center font-weight-bold">Other Amazing Features & Flexibility Provided</h2>
                    </v-col>
                </v-row>
                <v-row class="mt-10">
                    <v-col cols="12" md="3" sm="4" class="pl-sm-3 pt-sm-6 pr-sm-2" v-for="list in listFeature" :key="list.title">
                        <div class="text-center">
                            <Icon :icon="'solar:' + list.icon" height="40" class="text-primary" />
                            <h5 class="text-h5 heading mt-2">{{ list.title }}</h5>
                            <p class="text-body-1 text-muted mt-1 mb-6 text-13">{{ list.subtitle }}</p>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-container>
    </div>
</template>
