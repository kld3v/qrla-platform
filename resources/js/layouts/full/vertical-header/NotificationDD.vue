<script setup lang="ts">
import {notifications} from '@/_mockApis/headerData';
import { Icon } from '@iconify/vue';
</script>
<template>
    <!-- ---------------------------------------------- -->
    <!-- notifications DD -->
    <!-- ---------------------------------------------- -->
    <v-menu open-on-hover open-on-click >
        <template v-slot:activator="{ props }">
            <v-btn icon class="custom-hover-primary" size="small" variant="text" color="primary" v-bind="props">
                <Icon icon="solar:bell-bing-line-duotone" height="22"   />
            </v-btn>
        </template>
        <v-sheet rounded="md" width="360" elevation="10">
            <div class="px-6 pt-6 pb-4">
                <div class="d-flex align-center justify-space-between">
                    <h6 class="text-h5">Notifications</h6>
                    <v-chip color="primary" variant="flat" size="small" class="text-white rounded-sm">5 New</v-chip>
                </div>
            </div>
            <perfect-scrollbar style="height: 350px">
                <v-list class="py-0 theme-list" lines="two">
                    <v-list-item v-for="item in notifications" :key="item.title" :value="item" color="primary" class="py-3 px-6">
                        <template v-slot:prepend>
                            <v-avatar size="45" :color=" 'light' + item.color" rounded="circle">
                                <Icon :icon="'solar:' + item.avatar" height="20" :class="'text-' + item.color"/>
                            </v-avatar>
                        </template>
                        <div class="d-flex justify-space-between">
                            <h6 class="text-subtitle-1 heading mb-1">{{ item.title }}</h6>
                            <span class="text-subtitle-2 textSecondary">{{ item.time }}</span>
                        </div>
                        <p class="text-subtitle-2 font-weight-regular textSecondary">{{ item.subtitle }}</p>
                    </v-list-item>
                </v-list>
            </perfect-scrollbar>
            <div class="py-4 px-6 text-center">
                <v-btn color="primary" variant="flat" size="large" block>See all Notifications</v-btn>
            </div>
        </v-sheet>
    </v-menu>
</template>
