<script setup lang="ts">
import { ref } from 'vue';
import { Icon } from '@iconify/vue';
import { RevenueProjectsData } from '@/_mockApis/components/dashboard/dashboard1';
const select = ref('Sept 2024');
const items = ref(['Sept 2024', 'Oct 2024', 'Nov 2024']);
/*tab*/
const tab = ref(null);
</script>
<template>
    <v-card elevation="10" class="revenue-products">
        <v-card-item class="pb-4">
            <div class="d-flex gap-3 align-center justify-space-between">
                <v-card-title class="text-h5">Revenue by Product</v-card-title>
                <div>
                    <v-select
                        v-model="select"
                        :items="items"
                        variant="outlined"
                        density="compact"
                        class="text-body-1"
                        hide-details
                    ></v-select>
                </div>
            </div>
            <v-tabs v-model="tab" bg-color="transparent"  height="45" class="mt-3">
                <v-tab value="App" class="rounded-md font-weight-semibold"
                    ><Icon icon="solar:widget-linear" height="16" class="me-2" /> App</v-tab
                >
                <v-tab value="Mobile" class="rounded-md font-weight-semibold"
                    ><Icon icon="solar:smartphone-line-duotone" height="16" class="me-2" />Mobile</v-tab
                >
                <v-tab value="Sass" class="rounded-md font-weight-semibold"
                    ><Icon icon="solar:calculator-linear" height="16" class="me-2" />Sass</v-tab
                >
                <v-tab value="Others" class="rounded-md font-weight-semibold"
                    ><Icon icon="solar:folder-open-outline" height="16" class="me-2" />Others</v-tab
                >
            </v-tabs>
            <div class="mt-4">
                <v-window v-model="tab">
                    <!-- App Tab -->
                    <v-window-item value="App">
                        <v-table class="revenue-table light-border">
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-body-1 textPrimary">Assigned</th>
                                        <th class="text-body-1 textPrimary">Progress</th>
                                        <th class="text-body-1 textPrimary">Priority</th>
                                        <th class="text-body-1 textPrimary">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in RevenueProjectsData" :key="item.leadname" class="month-item">
                                        <td>
                                            <div class="d-flex align-center">
                                                <v-avatar size="48" rounded="md">
                                                    <img :src="item.img" :alt="item.img" width="48"
                                                /></v-avatar>
                                                <div class="mx-3">
                                                    <h6 class="text-subtitle-1 text-no-wrap mb-1">{{ item.leadname }}</h6>
                                                    <span class="text-body-1 text-no-wrap textSecondary">{{ item.designation }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-no-wrap text-body-1 textSecondary">
                                                {{ item.projectname }}
                                            </p>
                                        </td>
                                        <td>
                                            <v-chip
                                                rounded="sm"
                                                class="font-weight-semibold"
                                                :color="item.statuscolor"
                                                size="small"
                                                label
                                                >{{ item.statustext }}</v-chip
                                            >
                                        </td>
                                        <td>
                                            <p class="text-body-1">{{ item.money }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-table>
                    </v-window-item>
                    <!-- Mobile Tab -->
                    <v-window-item value="Mobile">
                        <v-table class="revenue-table light-border">
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-body-1">Assigned</th>
                                        <th class="text-body-1">Progress</th>
                                        <th class="text-body-1">Priority</th>
                                        <th class="text-body-1">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in RevenueProjectsData" :key="item.leadname" class="month-item">
                                        <td>
                                            <div class="d-flex align-center">
                                                <v-avatar size="48" rounded="md">
                                                    <img :src="item.img" :alt="item.img" width="48"
                                                /></v-avatar>
                                                <div class="mx-3">
                                                    <h6 class="text-subtitle-1 text-no-wrap font-weight-semibold  mb-1">{{ item.leadname }}</h6>
                                                    <span class="text-body-1 text-no-wrap textSecondary">{{ item.designation }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-no-wrap text-body-1 textSecondary">
                                                {{ item.projectname }}
                                            </p>
                                        </td>
                                        <td>
                                            <v-chip
                                                rounded="sm"
                                                class="ma-2 font-weight-semibold"
                                                :color="item.statuscolor"
                                                size="small"
                                                label
                                                >{{ item.statustext }}</v-chip
                                            >
                                        </td>
                                        <td>
                                            <p class="text-body-1">{{ item.money }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-table>
                    </v-window-item>
                    <!-- Sass Tab -->
                    <v-window-item value="Sass">
                        <v-table class="revenue-table light-border">
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-body-1">Assigned</th>
                                        <th class="text-body-1">Progress</th>
                                        <th class="text-body-1">Priority</th>
                                        <th class="text-body-1">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in RevenueProjectsData" :key="item.leadname" class="month-item">
                                        <td>
                                            <div class="d-flex align-center">
                                                <v-avatar size="48" rounded="md">
                                                    <img :src="item.img" :alt="item.img" width="48"
                                                /></v-avatar>
                                                <div class="mx-3">
                                                    <h6 class="text-subtitle-1 text-no-wrap font-weight-semibold  mb-1">{{ item.leadname }}</h6>
                                                    <span class="text-body-1 text-no-wrap textSecondary">{{ item.designation }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-no-wrap text-body-1 textSecondary">
                                                {{ item.projectname }}
                                            </p>
                                        </td>
                                        <td>
                                            <v-chip
                                                rounded="sm"
                                                class="ma-2 font-weight-semibold"
                                                :color="item.statuscolor"
                                                size="small"
                                                label
                                                >{{ item.statustext }}</v-chip
                                            >
                                        </td>
                                        <td>
                                            <p class="text-body-1">{{ item.money }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-table>
                    </v-window-item>
                    <!-- Others Tab -->
                    <v-window-item value="Others">
                        <v-table class="revenue-table light-border">
                            <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-body-1">Assigned</th>
                                        <th class="text-body-1">Progress</th>
                                        <th class="text-body-1">Priority</th>
                                        <th class="text-body-1">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in RevenueProjectsData" :key="item.leadname" class="month-item">
                                        <td>
                                            <div class="d-flex align-center">
                                                <v-avatar size="48" rounded="md">
                                                    <img :src="item.img" :alt="item.img" width="48"
                                                /></v-avatar>
                                                <div class="mx-3">
                                                    <h6 class="text-subtitle-1 text-no-wrap font-weight-semibold  mb-1">{{ item.leadname }}</h6>
                                                    <span class="text-body-1 text-no-wrap textSecondary">{{ item.designation }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-no-wrap text-body-1 textSecondary">
                                                {{ item.projectname }}
                                            </p>
                                        </td>
                                        <td>
                                            <v-chip
                                                rounded="sm"
                                                class="ma-2 font-weight-semibold"
                                                :color="item.statuscolor"
                                                size="small"
                                                label
                                                >{{ item.statustext }}</v-chip
                                            >
                                        </td>
                                        <td>
                                            <p class="text-body-1">{{ item.money }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-table>
                    </v-window-item>
                </v-window>
            </div>
        </v-card-item>
    </v-card>
</template>
