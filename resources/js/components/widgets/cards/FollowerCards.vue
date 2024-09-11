<script setup lang="ts">
import {followerCard} from '@/_mockApis/components/widget/card';
</script>
<template>
    <v-row class="pt-3">
        <v-col cols="12" md="4" v-for="card in followerCard" :key="card.title">
            <v-card elevation="10"  rounded="md">
                <v-card-item>
                    <div class="d-flex align-center">
                        <v-avatar size="40" >    
                            <img :src="card.avatar" :alt="card.avatar" width="40"/>
                        </v-avatar>
                        <div class="pl-4 mt-n1">
                            <h5 class="text-h5" v-text="card.title"></h5>
                            <p class="text-body-1 textSecondary d-flex align-center"><MapPinIcon size="15" class="mr-1"/>{{card.location}}</p>
                        </div>
                        <v-btn class="ml-auto" color="primary" flat>Follow</v-btn>
                    </div>    
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</template>
