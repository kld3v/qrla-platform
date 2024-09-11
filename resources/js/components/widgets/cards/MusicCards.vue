<script setup lang="ts">
import {musicCard} from '@/_mockApis/components/widget/card';
</script>
<template>
    <v-row>
        <v-col cols="12" md="4" v-for="card in musicCard" :key="card.title">
            <v-card elevation="10"  class="overflow-visible">
                <v-row class="mt-md-0 mt-sm-3 mt-3">
                    <v-col cols="6" sm="6">
                        <v-card-item class="pb-3">
                            <h5 class="text-h5" v-text="card.title"></h5>
                            <div class="text-body-1 textSecondary mt-1" v-text="card.subheader"></div>
                            <div class="d-flex align-center justify-center mt-8 ">
                            <v-btn size="20" icon variant="flat" class="grey100">
                                <v-avatar size="20">
                                    <PlayerSkipBackIcon size="15" color="grey100" />
                                </v-avatar>
                            </v-btn>
                            <v-btn size="20" icon variant="flat" class="mx-6 text-error">
                                <v-avatar size="20">
                                    <PlayerPlayIcon size="15" class="text-error" />
                                </v-avatar>
                            </v-btn>
                            <v-btn size="20" icon variant="flat" class="grey100">
                                <v-avatar size="20">
                                    <PlayerSkipForwardIcon size="15" />
                                </v-avatar>
                            </v-btn>
                        </div>
                        </v-card-item>
                        
                    </v-col>
                    <v-col cols="6" sm="6" class="py-0 pl-0">
                        <img :src="card.img"  class="rounded-e-md w-100 h-100 obj-cover"></img>
                    </v-col>
                </v-row>
            </v-card>
        </v-col>
    </v-row>
</template>
