<script setup lang="ts">
import { ref, watch } from 'vue';
import { useCustomizerStore } from '@/stores/customizer';
import Logo from '@/layouts/full/logo/Logo.vue';

import Navigations from '@/components/landingpage/layout/Navigation.vue';
/*Mobile Sidebar*/
import MobileSidebar from '@/components/landingpage/layout/MobileSidebar.vue';
/*import tabler icons*/
import { Menu2Icon } from 'vue-tabler-icons';
const appsdrawer = ref(false);
const customizer = useCustomizerStore();
</script>
<template>

        <div>
            <v-app-bar height="80" class="lp-header" flat>
                <v-container class="py-sm-4 py-0">
                    <div class="maxWidth">
                        <v-toolbar class="d-flex align-center">
                            <!-- Logo -->
                            <div>
                                <Logo />
                            </div>
                            <!-- Desktop view Navigation -->
                            <div class="navigation ml-auto d-lg-flex d-none">
                                <Navigations />
                            </div>
                            <v-btn variant="text" class="hidden-lg-and-up ml-auto" icon @click.stop="appsdrawer = !appsdrawer">
                                <Menu2Icon size="22" stroke-width="1.5" />
                            </v-btn>
                        </v-toolbar>
                    </div>
                </v-container>
            </v-app-bar>
        </div>

        <!----sidebar menu drawer start----->
        <v-navigation-drawer class="lp-drawer" v-model="appsdrawer" location="left" temporary>
            <MobileSidebar />
        </v-navigation-drawer>
   
</template>
