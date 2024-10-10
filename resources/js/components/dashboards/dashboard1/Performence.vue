<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
import { getSecondary, getLightSecondary } from '@/utils/UpdateColors';
import { PerformanceData } from '@/_mockApis/components/dashboard/dashboard1';
/* Chart */
const chartOptions = computed(() => {
    return {
        labels: ['245', '45', '14', '78', '95'],
        chart: {
            height: 230,
            fontFamily: 'inherit',
            type: 'donut'
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 90,
                offsetY: 10,
                donut: {
                    size: '90%'
                }
            }
        },
        grid: {
            padding: {
                bottom: -80
            }
        },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false,
            name: {
                show: false
            }
        },
        stroke: {
            width: 2,
            colors: 'rgba(var(--v-theme-surface))'
        },
        tooltip: {
            fillSeriesColor: false
        },
        colors: ['#ff6692', '#ffd648', '#FFF7DA', getLightSecondary.value, getSecondary.value],
        responsive: [
            {
                breakpoint: 1370,
                options: {
                    chart: {
                        height: 180,
                    }
                }
            },
            {
                breakpoint: 600,
                options: {
                    chart: {
                        height: 200
                    }
                }
            }
        ]
    };
});

const Chart = [20, 20, 20, 20, 20];
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Your Performance</v-card-title>
            <v-card-subtitle class="text-subtitle-1">Last check on 25 february</v-card-subtitle>
            <v-row class="mt-4">
                <v-col cols="12" md="6" class="d-flex flex-column gap-4">
                    <div class="d-flex gap-3 align-center" v-for="item in PerformanceData" :key="item.title">
                        <v-avatar size="45" :color="'light' + item.color" rounded="md">
                            <Icon :icon="'solar:' + item.icon" height="25" :class="'text-' + item.color" />
                        </v-avatar>
                        <div>
                            <h6 class="heading text-subtitle-1">{{ item.title }}</h6>
                            <p class="textSecondary">{{ item.subtitle }}</p>
                        </div>
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <div class="text-center mt-sm-n7">
                        <apexchart type="donut" height="230" :options="chartOptions" :series="Chart"> </apexchart>
                        <div class="mt-n4">
                            <h2 class="text-h2 heading">275</h2>
                            <p class="mb-0 mt-3 textSecondary">Learn insigs how to manage all aspects of your startup.</p>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card-item>
    </v-card>
</template>
