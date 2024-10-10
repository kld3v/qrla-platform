<script setup lang="ts">
import { computed } from 'vue';
import { getPrimary, getSecondary } from '@/utils/UpdateColors';

/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            toolbar: {
                show: false
            },
            height: 80,
            type: 'bar',
            sparkline: {
                enabled: true
            },
            fontFamily: 'inherit',
            foreColor: '#adb0bb'
        },
        colors: [getPrimary.value],
        grid: {
            show: false,
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 3,
                columnWidth: '40%',
                distributed: true,
                endingShape: 'all',
                borderRadiusApplication: 'end'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2.5,
            colors: ['rgba(0,0,0,0.01)']
        },
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                show: false
            }
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        axisBorder: {
            show: false
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'dark',
            x: {
                show: false
            }
        }
    };
});
const Chart = [
    {
        name: '',
        data: [4, 10, 9, 7, 9, 10]
    }
];
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <p class="text-subtitle-1 textSecondary">Projects</p>
            <h4 class="text-h4 my-1">78,298</h4>
            <div>
                <v-avatar class="bg-lightsuccess" size="20">
                    <ArrowUpLeftIcon size="15" class="text-success" />
                </v-avatar>
                <span class="text-body-1 ms-2 textSecondary">+9%</span>
            </div>
            <apexchart class="" type="bar" height="80" :options="chartOptions" :series="Chart"> </apexchart>
        </v-card-item>
    </v-card>
</template>
