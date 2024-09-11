<script setup lang="ts">
import { computed } from 'vue';
import { getSecondary } from '@/utils/UpdateColors';
import { Icon } from '@iconify/vue';
/* Chart */
const areachartOptions = computed(() => {
    return {
        chart: {
            type: 'area',
            height: 90,
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
        <v-card-item class="space-20">
            <div class="d-flex align-center justify-space-between">
                <div>
                    <p class="mb-1 font-weight-semibold textPrimary">Users</p>
                    <div class="d-flex align-center gap-3">
                        <h3 class="text-24 heading">14,872</h3>
                        <span class="font-weight-medium textPrimary">+6.4%</span>
                    </div>
                </div>
                <v-avatar size="48" class="rounded-md bg-surface">
                    <Icon icon="solar:pie-chart-3-line-duotone" class="text-secondary" height="22" />
                </v-avatar>
            </div>
        </v-card-item>
        <apexchart type="area" height="90"  class="mt-4" :options="areachartOptions" :series="areaChart.series"> </apexchart>
    </v-card>
</template>
