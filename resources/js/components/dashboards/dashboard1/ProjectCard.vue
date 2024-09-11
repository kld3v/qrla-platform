<script setup lang="ts">
import { computed } from 'vue';
import { getSecondary } from '@/utils/UpdateColors';

/* Chart */
const barchartOptions = computed(() => {
    return {
        chart: {
            fontFamily: 'inherit',
            height: 55,
            type: 'bar',
            offsetX: -3,
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['#fff'],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'flat',
                borderRadius: 4
            }
        },
        tooltip: {
            theme: 'dark',
            followCursor: true
        }
    };
});

const barChart = {
    series: [
        {
            name: "Project",
            data: [3, 5, 5, 7, 6, 5, 3, 5, 3],
            labels: ["2012", "2013", "2014", "2015", "2016", "2017"],
        }
    ]
};
</script>
<template>
    <v-card elevation="0" class="bg-lighterror overflow-hidden">
        <v-card-item class="pa-6">
            <p class="mb-1 textPrimary">Projects</p>
            <div class="d-flex align-center gap-3">
                <h3 class="text-24 heading">78,298</h3>
                <span class="font-weight-medium textPrimary">+31.8%</span>
            </div>
            <div class="mx-n2 mt-4">
                <apexchart type="bar" height="55" :options="barchartOptions" :series="barChart.series"> </apexchart>
            </div>
        </v-card-item>
    </v-card>
</template>
