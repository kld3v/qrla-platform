<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            toolbar: {
                show: false
            },

            height: 220,
            type: 'bar',
            offsetX: -8,
            fontFamily: 'inherit',
            foreColor: '#adb0bb'
        },
        colors: [
            'rgba(var(--v-theme-grey100))',
            'rgba(var(--v-theme-grey100))',
            'rgba(var(--v-theme-grey100))',
            'rgba(var(--v-theme-primary))',
            'rgba(var(--v-theme-grey100))',
            'rgba(var(--v-theme-grey100))',
            'rgba(var(--v-theme-grey100))'
        ],
        plotOptions: {
            bar: {
                borderRadius: 5,
                columnWidth: '55%',
                distributed: true,
                endingShape: 'rounded'
            }
        },

        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        grid: {
            yaxis: {
                lines: {
                    show: false
                }
            },
            xaxis: {
                lines: {
                    show: false
                }
            }
        },
        xaxis: {
            categories: [['Apr'], ['May'], ['June'], ['July'], ['Aug'], ['Sept'], ['Oct']],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        tooltip: {
            theme: 'dark'
        }
    };
});

const Chart = {
    series: [
        {
            name: 'Weekly Stats',
            data: [20, 15, 18, 25, 10, 15, 20]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Weekly Stats</v-card-title>
            <v-card-subtitle class="text-subtitle-1">Overview of Profit</v-card-subtitle>
            <div class="mx-n6">
                <apexchart type="bar" height="220" :options="chartOptions" :series="Chart.series"> </apexchart>
            </div>
            <v-divider class="mb-7 mt-5"></v-divider>
            <div class="d-flex justify-space-between align-center gap-2">
                    <div class="d-flex gap-3 align-center">
                        <v-avatar size="48" color="" class="bg-lighterror rounded-md">
                            <Icon icon="solar:course-down-linear" class="text-error" height="25" />
                        </v-avatar>
                        <div>
                            <p class="textSecondary">Sales</p>
                            <h5 class="text-subtitle-1 font-weight-bold">$36,850</h5>
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-center">
                        <v-avatar size="48" color="" class="bg-lightprimary rounded-md">
                            <Icon icon="solar:chart-linear" class="text-primary" height="25" />
                        </v-avatar>
                        <div>
                            <p class="textSecondary">Expenses</p>
                            <h5 class="text-subtitle-1 font-weight-bold">$4,720</h5>
                        </div>
                    </div>
            </div>
        </v-card-item>
    </v-card>
</template>
