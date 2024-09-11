<script setup lang="ts">
import { computed } from 'vue';
import { getSecondary } from '@/utils/UpdateColors';

/* Chart */
const areachartOptions = computed(() => {
    return {
        chart: {
            type: 'area',
            height: 70,
            sparkline: {
                enabled: true
            },
            group: 'sparklines',
            fontFamily: 'inherit',
            foreColor: '#adb0bb'
        },
        colors: [getSecondary.value],
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            color: [getSecondary.value],
            gradient: {
                shadeIntensity: 0,
                inverseColors: false,
                opacityFrom: 0.4,
                opacityTo: 0.9,
                stops: [100]
            }
        },
        markers: {
            size: 0
        },
        tooltip: {
            theme: 'dark',
            fixed: {
                enabled: true,
                position: 'right'
            },
            x: {
                show: false
            }
        }
    };
});

const areaChart = {
    series: [
        {
            name: "customers",
            data: [36, 45, 31, 47, 38, 43]
        }
    ]
};
</script>
<template>
    <v-card elevation="0" class="bg-lightsecondary overflow-hidden">
        <v-card-item class="pa-6">
            <p class="mb-1 textPrimary">Customers</p>
            <div class="d-flex align-center gap-3">
                <h3 class="text-24 heading">36,358</h3>
                <span class="font-weight-medium textPrimary">-12%</span>
            </div>
        </v-card-item>
        <apexchart type="area" height="70" :options="areachartOptions" :series="areaChart.series"> </apexchart>
    </v-card>
</template>
