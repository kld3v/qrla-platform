<script setup lang="ts">
import {upcommingCards} from '@/_mockApis/components/widget/card';
</script>
<template>
    <v-card elevation="10" >
        <v-card-item class="pb-sm-8 pb-6">
            <v-card-title class="text-h5">Upcoming Activity</v-card-title>
            <v-card-subtitle class="text-subtitle-1 ">In New year</v-card-subtitle>
            <div class="">
                <div class="d-flex align-center mt-6" v-for="list in upcommingCards" :key="list.title">
                    <v-avatar :class="'rounded-md bg-light'+ list.bgcolor"  size="45">    
                        <component :is="list.icon" :class="'text-'+ list.bgcolor" stroke-width="2" size="20" />
                    </v-avatar>
                    <div class="pl-4 ">
                        <h5 class="text-h6 mb-1" v-text="list.title"></h5>
                        <p class="text-subtitle-1 textSecondary" v-text="list.subtitle"></p>
                    </div>
                    <div class="ml-auto font-weight-medium text-subtitle-1 textSecondary" v-text="list.rank"></div>
                </div>
            </div>
        </v-card-item>
    </v-card>
</template>
