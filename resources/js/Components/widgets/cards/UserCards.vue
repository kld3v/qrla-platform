<script setup lang="ts">
import { userCards } from '@/_mockApis/components/widget/card';
</script>
<template>
    <v-row>
        <v-col cols="12" md="3" sm="6" v-for="card in userCards" :key="card.title">
            <v-card elevation="10"  rounded="md">
                <v-card-item>
                    <v-avatar size="80" >    
                        <img :src="card.avatar" :alt="card.avatar" width="80"/>
                    </v-avatar>
                    <div class="mt-6">
                        <h5 class="text-h5 mb-2" v-text="card.title"></h5>
                        <div class="d-flex align-center justify-space-between">
                            <div class="ml-2 d-flex ">
                                <v-avatar size="32" class="ml-n2 avtar-border" v-for="user in card.userGroup" :key="user.icon">
                                    <img :src="user.icon" alt="avatar" height="32"/>
                                </v-avatar>
                            </div>
                            <p class="text-subtitle-1 textSecondary">{{card.subtitle}}</p>
                        </div>    
                    </div>
                    <div class="mt-6">
                        <v-btn color="primary" variant="tonal"  block >Add friend</v-btn>
                        <v-btn color="secondary" variant="tonal" class="mt-3" block >Remove</v-btn>
                    </div>    
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</template>
