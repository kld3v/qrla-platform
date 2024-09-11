<script setup lang="ts">
import { computed } from 'vue';
import { getPrimary, getSecondary } from '@/utils/UpdateColors';

/* Chart */
const chartOptions = computed(() => {
    return {
        labels: ['36%', '10%', '36%'],
        chart: {
            type: 'radialBar',
            height: 220,
            fontFamily: 'inherit',
            foreColor: '#c6d1e9'
        },
        plotOptions: {
            radialBar: {
                inverseOrder: false,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                    margin: 1,
                    size: '40%'
                },
                dataLabels: {
                    show: false
                }
            }
        },
        legend: {
            show: false
        },
        stroke: { width: 1, lineCap: 'round' },
        tooltip: {
            enabled: false,
            fillSeriesColor: false
        },
        colors: [getPrimary.value, getSecondary.value, 'rgba(var(--v-theme-error))']
    };
});
const Chart = [50, 80, 30];
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <div class="mb-3">
                <v-card-title class="text-h5">Sales Overview</v-card-title>
                <v-card-subtitle class="text-subtitle-1">Last 7 days</v-card-subtitle>
            </div>
            <div class="position-relative labels-chart">
                <span class="text-body-2 textSecondary label-1">0%</span>
                <span class="text-body-2 textSecondary label-2">25%</span>
                <span class="text-body-2 textSecondary label-3">50%</span>
                <span class="text-body-2 textSecondary label-4">75%</span>
                <apexchart type="radialBar" height="220" :options="chartOptions" :series="Chart"> </apexchart>
            </div>
        </v-card-item>
    </v-card>
</template>
