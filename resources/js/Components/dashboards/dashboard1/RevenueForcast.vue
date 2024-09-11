<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
import { getSecondary, getPrimary } from '@/utils/UpdateColors';

/* Chart */
const areachartOptions = computed(() => {
    return {
        chart: {
            toolbar: {
                show: false
            },
            type: 'area',
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            height: 290,
            width: '100%',
            stacked: false,
            
        },
        colors: ['#ff6692', getSecondary.value, getPrimary.value],
        plotOptions: {},
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        stroke: {
            width: 2,
            curve: 'monotoneCubic'
        },
        grid: {
            show: true,
            padding: {
                top: 0,
                bottom: 0
            },
            borderColor: 'rgba(0,0,0,0.05)',
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0,
                inverseColors: false,
                opacityFrom: 0.2,
                opacityTo: 0.9,
                stops: [100]
            }
        },
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug']
        },
        markers: {
            strokeColor: ['#ff6692', getSecondary.value, getPrimary.value],
            strokeWidth: 2
        },
        tooltip: {
            theme: 'dark'
        }
    };
});

const areaChart = {
    series: [
        {
            name: '2023',
            data: [50, 60, 30, 55, 75, 60, 100, 120]
        },

        {
            name: '2022',
            data: [35, 45, 40, 50, 35, 55, 40, 45]
        },
        {
            name: '2024',
            data: [100, 75, 80, 40, 20, 40, 0, 25]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item class="pb-2">
            <div class="d-md-flex justify-space-between mb-mb-0 mb-3">
                <div class="d-flex gap-3 align-center">
                    <v-avatar size="48" class="rounded-md bg-lightprimary">
                        <Icon icon="solar:layers-linear" class="text-primary" height="25" />
                    </v-avatar>
                    <div>
                        <v-card-title class="text-h5">Revenue Forecast</v-card-title>
                        <v-card-subtitle class="text-subtitle-1">Overview of Profit</v-card-subtitle>
                    </div>
                </div>
                <div class="d-flex align-center gap-4">
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="8" class="bg-primary rounded-circle"></v-avatar>
                        <span class="textSecondary">2024</span>
                    </div>
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="8" class="bg-error rounded-circle"></v-avatar>
                        <span class="textSecondary">2023</span>
                    </div>
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="8" class="bg-secondary rounded-circle"></v-avatar>
                        <span class="textSecondary">2022</span>
                    </div>
                </div>
            </div>
            <div class="mx-n4 mt-5 pt-2">
                <apexchart type="area" height="290" :options="areachartOptions" :series="areaChart.series"> </apexchart>
            </div>
        </v-card-item>
    </v-card>
</template>
