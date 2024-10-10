<script setup>
import { ref } from 'vue';
import user1 from '@/assets/images/profile/user-1.jpg';
</script>

<template>
    <v-sheet>
        <!---Topbar Row-->
        <div class="d-flex gap-2 align-center pa-6 pb-3">
            <!---User Avatar-->
            <v-avatar size="large">
                <img :src="user1" alt="pro" width="54" />
            </v-avatar>

            <v-badge class="badg-dotDetail" dot color="success"> </v-badge>
            <!---Name & Last seen-->
            <div>
                <h5 class="text-subtitle-1 font-weight-semibold">David McMichael</h5>
                <p class="text-12 textSecondary">Designer</p>
            </div>
        </div>
    </v-sheet>
</template>
