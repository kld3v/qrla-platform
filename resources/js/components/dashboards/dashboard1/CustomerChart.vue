<script setup lang="ts">
import { computed } from 'vue';
import { getPrimary, getLightPrimary } from '@/utils/UpdateColors';

/* Chart */
const barchartOptions = computed(() => {
    return {
        chart: {
            fontFamily: 'inherit',
            height: 100,
            type: 'line',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: [getPrimary.value, getLightPrimary.value],
        grid: {
            show: false
        },
        stroke: {
            curve: 'smooth',
            colors: [getPrimary.value, getLightPrimary.value],
            width: 2
        },
        markers: {
            colors: [getPrimary.value, getLightPrimary.value],
            strokeColors: 'transparent'
        },
        tooltip: {
            theme: 'dark',
            x: {
                show: false
            },
            followCursor: true
        }
    };
});

const barChart = {
    series: [
        {
            name: 'April 07 ',
            data: [0, 20, 15, 19, 14, 25, 30]
        },
        {
            name: 'Last Week',
            data: [0, 8, 19, 13, 26, 16, 25]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <div class="d-md-flex justify-space-between mb-mb-0 mb-3">
                <div>
                    <v-card-title class="text-h5">Customers</v-card-title>
                    <v-card-subtitle class="text-subtitle-1">Last 7 days</v-card-subtitle>
                </div>
                <span class="text-success text-caption font-weight-semibold">+26.5%</span>
            </div>
            <apexchart class="mt-7" type="line" height="100" :options="barchartOptions" :series="barChart.series"> </apexchart>
            <div class="mt-9">
                <div class="d-flex justify-space-between mb-2">
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="10" class="bg-primary rounded-circle"></v-avatar>
                        <span class="text-muted">April 07 - April 14</span>
                    </div>
                    <p class="text-muted">6,380</p>
                </div>
                <div class="d-flex justify-space-between">
                    <div class="d-flex align-center gap-2">
                        <v-avatar size="10" class="bg-grey100 rounded-circle"></v-avatar>
                        <span class="text-muted">Last Week</span>
                    </div>
                    <p class="text-muted">4,298</p>
                </div>
            </div>
        </v-card-item>
    </v-card>
</template>
