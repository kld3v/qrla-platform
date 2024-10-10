<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
import { RevenueForecastData } from '@/_mockApis/components/dashboard/dashboard2';

/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            toolbar: {
                show: false
            },
            type: 'bar',
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            height: 295,
            stacked: true,
            offsetX: -15
        },
        colors: ['rgba(var(--v-theme-primary))', 'rgba(var(--v-theme-error))'],
        plotOptions: {
            bar: {
                horizontal: false,
                barHeight: '60%',
                columnWidth: '15%',
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        grid: {
            show: true,
            padding: {
                top: 0,
                bottom: 0,
                right: 0
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
        yaxis: {
            min: -5,
            max: 5,
            tickAmount: 4
        },
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep'],
            labels: {
                style: { fontSize: '13px', colors: '#adb0bb', fontWeight: '400' }
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
            name: '2024',
            data: [1.2, 2.7, 1, 3.6, 2.1, 2.7, 2.2, 1.3, 2.5]
        },
        {
            name: '2023',
            data: [-2.8, -1.1, -2.5, -1.5, -2.3, -1.9, -1, -2.1, -1.3]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <div class="d-md-flex justify-space-between mb-mb-0 mb-3">
                <div>
                    <v-card-title class="text-h5">Revenue Forecast</v-card-title>
                    <v-card-subtitle class="text-subtitle-1">Overview of Profit</v-card-subtitle>
                </div>
                <div class="d-flex align-center gap-4">
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="10" class="bg-primary rounded-circle"></v-avatar>
                        <span class="textSecondary">2024</span>
                    </div>
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="10" class="bg-error rounded-circle"></v-avatar>
                        <span class="textSecondary">2023</span>
                    </div>
                </div>
            </div>
            <div class="mx-n1 mt-4 pt-2">
                <apexchart type="bar" height="295" class="rounded-bars" :options="chartOptions" :series="Chart.series"> </apexchart>
            </div>
            <v-row class="mt-1">
                <v-col v-for="item in RevenueForecastData" :key="item.subtext" cols="12" md="4">
                    <div class="d-flex gap-3 align-center">
                        <v-avatar size="48" color="item.bgcolor" class="rounded-md" :class="item.bgcolor">
                            <Icon :icon="'solar:' + item.icon" height="25" :class="item.color" />
                        </v-avatar>
                        <div>
                            <p class="textSecondary">{{ item.subtext }}</p>
                            <h5 class="text-h5 font-weight-medium">{{ item.profit }}</h5>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card-item>
    </v-card>
</template>
