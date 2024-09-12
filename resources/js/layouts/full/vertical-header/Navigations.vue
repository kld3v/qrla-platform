<script setup lang="ts">
import { ref } from 'vue';
import { Icon } from '@iconify/vue';
import AppsLink from './AppsLink.vue';
</script>

<template>
    <!-- ---------------------------------------------- -->
    <!-- mega menu DD -->
    <!-- ---------------------------------------------- -->
    <v-menu open-on-hover open-on-click >
        <template v-slot:activator="{ props }">
            <v-btn class="hidden-sm-and-down custom-hover-primary"  size="small" variant="text" icon color="primary" v-bind="props">  <Icon icon="solar:widget-3-line-duotone"  height="20"   /> </v-btn>
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
                        <img src="@/assets/images/backgrounds/mega-dd-bg.jpg" alt="matdash-img" height="320" class="w-100"  />
                    </v-col>
                </v-row>
            </div>
        </v-sheet>
    </v-menu>
</template>
s