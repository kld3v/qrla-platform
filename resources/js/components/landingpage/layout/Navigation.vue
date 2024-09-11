<script setup lang="ts">
import { Icon } from '@iconify/vue';
import AppsLink from '@/layouts/full/vertical-header/AppsLink.vue';
import { demosMegamenu, appsMegamenu } from '@/_mockApis/landingpage/lpPage';
import { ChevronDownIcon } from 'vue-tabler-icons';
</script>

<template>
    <!-- ---------------------------------------------- -->
    <!-- mega menu DD -->
    <!-- ---------------------------------------------- -->
    <v-menu open-on-hover :close-on-content-click="false" class="lp_wrapper position-relative">
        <template v-slot:activator="{ props }">
            <v-btn class="hidden-sm-and-down nav-links custom-hover-primary font-weight-medium" variant="text" v-bind="props"
                >Demos<ChevronDownIcon size="18" class="mt-1 ml-1" />
            </v-btn>
        </template>
        <v-sheet max-width="100%" width="1150" height="100%" elevation="10" rounded="md" class="pa-8 mx-auto">
            <h5 class="text-h5">Different Demos</h5>
            <p class="text-subtitle-1 font-weight-medium textSecondary mt-1">Included with the package</p>
            <div class="v-row mt-3">
                <v-col v-for="demo in demosMegamenu" :key="demo.img">
                    <v-sheet class="text-center position-relative">
                        <div class="overflow-hidden rounded-md border">
                            <v-hover v-slot="{ isHovering, props }">
                                <v-card class="mx-auto" v-bind="props" rounded="0">
                                    <img :src="demo.img" :alt="demo.img" class="w-100" />
                                    <v-overlay
                                        :model-value="isHovering"
                                        class="align-center justify-center"
                                        scrim="rgba(55, 114, 255, 0.5)"
                                        contained
                                    >
                                        <v-btn color="primary" size="small" flat target="_blank" :href="demo.link">Live Preview</v-btn>
                                    </v-overlay>
                                </v-card>
                            </v-hover>
                        </div>
                    </v-sheet>
                    <p class="text-body-1 font-weight-medium text-center mt-1">{{ demo.name }}</p>
                </v-col>
            </div>
            <div class="mt-8">
                <h5 class="text-h5">Different Apps</h5>
                <div class="v-row mt-3">
                    <v-col v-for="demo in appsMegamenu" :key="demo.img">
                        <v-sheet class="text-center position-relative">
                            <div class="overflow-hidden rounded-md border">
                                <v-hover v-slot="{ isHovering, props }">
                                    <v-card class="mx-auto" v-bind="props" rounded="0">
                                        <img :src="demo.img" :alt="demo.img" class="w-100" />
                                        <v-overlay
                                            :model-value="isHovering"
                                            class="align-center justify-center"
                                            scrim="rgba(55, 114, 255, 0.5)"
                                            contained
                                        >
                                            <v-btn color="primary" size="small" flat target="_blank" :href="demo.link">Live Preview</v-btn>
                                        </v-overlay>
                                    </v-card>
                                </v-hover>
                            </div>
                        </v-sheet>
                        <p class="text-body-1 font-weight-medium text-center mt-1">{{ demo.name }}</p>
                    </v-col>
                </div>
            </div>
        </v-sheet>
    </v-menu>
    <v-menu open-on-hover open-on-click>
        <template v-slot:activator="{ props }">
            <v-btn class="hidden-sm-and-down nav-links custom-hover-primary font-weight-medium" variant="text" v-bind="props"
                >Pages<ChevronDownIcon size="18" class="mt-1 ml-1" />
            </v-btn>
        </template>
        <v-sheet width="900" height="300" elevation="10" rounded="md" class="pa-0 overflow-hidden">
            <div>
                <v-row>
                    <v-col cols="12" md="8" class="d-flex">
                        <div class="pa-6">
                            <AppsLink />
                        </div>
                    </v-col>
                    <v-col cols="12" md="4" class="pa-0">
                        <img src="@/assets/images/backgrounds/mega-dd-bg.jpg" alt="matdash-img" height="320" class="w-100" />
                    </v-col>
                </v-row>
            </div>
        </v-sheet>
    </v-menu>
    <v-btn
        variant="text"
        class="custom-hover-primary font-weight-medium nav-links"
        href="https://demos.adminmart.com/premium/vue/matdash-vuejs/docs/index.html"
        target="_blank"
        >Documentation</v-btn
    >
    <v-btn variant="text" class="custom-hover-primary font-weight-medium nav-links" href="https://adminmart.com/support/" target="_blank"
        >Support</v-btn
    >
    <v-btn class="custom-hover-primary bg-primary ml-2 text-white px-6" flat href="/auth/login2" target="_blank"
        ><span class="text-white">Login</span></v-btn
    >
</template>
