<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
/* Chart */
const barchartOptions = computed(() => {
    return {
        chart: {
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            type: 'bar',
            height: 98,
            stacked: true,
            offsetX: -5,
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['#ffffff', 'rgba(255,255,255,0.5)'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '26%',
                borderRadius: [3],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            }
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            theme: 'dark'
        },
        legend: {
            show: false
        }
    };
});

const barChart = {
    series: [
        {
            name: 'Site A',
            data: [29, 52, 38, 47, 56, 41, 46]
        },
        {
            name: 'Site B',
            data: [71, 71, 71, 71, 71, 71, 71]
        }
    ]
};
</script>
<template>
    <v-card elevation="0" class="bg-lighterror overflow-hidden">
        <v-card-item class="space-20">
            <div class="d-flex align-center justify-space-between">
                <div>
                    <p class="mb-1 font-weight-semibold textPrimary">Subscriptions</p>
                    <div class="d-flex align-center gap-3">
                        <h3 class="text-24 heading">78,298</h3>
                        <span class="font-weight-medium textPrimary">-12%</span>
                    </div>
                </div>
                <v-avatar size="48" class="rounded-md bg-surface">
                    <Icon icon="solar:layers-linear" class="text-error" height="22" />
                </v-avatar>
            </div>

            <div class="mt-2">
                <apexchart type="bar" height="98" :options="barchartOptions" :series="barChart.series" class="rounded-bars"> </apexchart>
            </div>
        </v-card-item>
    </v-card>
</template>
