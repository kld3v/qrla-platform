<script setup >
import { Icon } from '@iconify/vue';
const props = defineProps({
    title: String,
    breadcrumbs: Array ,
    icon: String,
    text: String
});


</script>

<template>
    <v-card elevation="10" class="mb-8">
        <div class="px-6 py-4">
            <div class="d-flex justify-space-between align-center">
                <h5 class="text-h5">{{ title }}</h5>
                <v-breadcrumbs :items="breadcrumbs" class="pa-0">
                        <template v-slot:prepend>
                            <router-link to="/" class="textSecondary lh-0">
                                <Icon icon="solar:home-2-line-duotone" height="20"   />
                            </router-link>
                        </template>
                        <template v-slot:divider>
                            <div class="d-flex align-center textSecondary "></div>
                        </template>
                        <template v-slot:title="{ item }">
                            <v-chip size="small" class="rounded-sm" color="primary" >{{ item.text }}</v-chip>
                        </template>
                    </v-breadcrumbs>
                
            </div>
        </div>
    </v-card>
</template>

<style lang="scss">
.page-breadcrumb {
    .v-toolbar {
        background: transparent;
    }
}
</style>
