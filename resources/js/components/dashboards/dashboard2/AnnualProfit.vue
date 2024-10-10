<script setup lang="ts">
import { computed } from 'vue';
import { getPrimary } from '@/utils/UpdateColors';
import { AnnualProfitData } from '@/_mockApis/components/dashboard/dashboard2';
/* Chart */
const areachartOptions = computed(() => {
    return {
        chart: {
            type: 'area',
            height: 80,
            sparkline: {
                enabled: true
            },
            group: 'sparklines',
            fontFamily: 'inherit',
            foreColor: '#adb0bb'
        },
        colors: [getPrimary.value],
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            color: [getPrimary.value],
            gradient: {
                shadeIntensity: 0,
                inverseColors: false,
                opacityFrom: 0.3,
                opacityTo: 0.4,
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
            name: 'Users',
            data: [25, 66, 20, 40, 12, 58, 20]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Annual Profit</v-card-title>
            <div class="bg-lightprimary-100 rounded-md mt-5">
                <div class="d-flex justify-space-between align-center pa-6">
                    <span class="textPrimary font-weight-medium">Conversion Rate</span>
                    <h3 class="text-h3 heading">18.4%</h3>
                </div>
                <apexchart type="area" class="mt-5" height="80" :options="areachartOptions" :series="areaChart.series"> </apexchart>
            </div>
            <div class="d-flex flex-column gap-3 mt-6 annual-list">
                <div v-for="item in AnnualProfitData" :key="item.title" class="list border-b pb-4">
                    <div class="d-flex justify-space-between">
                        <div>
                            <p class="font-weight-medium text-muted mb-1">{{ item.title }}</p>
                            <span class="font-weight-medium text-right textSecondary">{{ item.subtitle }}</span>
                        </div>
                        <div>
                            <h6 class="text-subtitle-1 font-weight-bold heading mb-1">{{ item.price }}</h6>
                            <p :class="'font-weight-semibold text-right text-' + item.color">{{ item.percent }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </v-card-item>
    </v-card>
</template>
