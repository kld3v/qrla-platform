<script setup lang="ts">
import { computed } from 'vue';

import { getPrimary, getLight100, getLightPrimary } from '@/utils/UpdateColors';

/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            height: 310,
            type: 'bar',
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            toolbar: {
                show: false
            }
        },
        colors: [
            getLightPrimary.value,
            getLightPrimary.value,
            getPrimary.value,
            getLightPrimary.value,
            getLightPrimary.value,
            getLightPrimary.value,
            getLightPrimary.value,
            ,
            getLightPrimary.value,
            ,
            getLightPrimary.value,
            getLightPrimary.value
        ],
        plotOptions: {
            bar: {
                borderRadius: 3,
                columnWidth: '53%',
                distributed: true,
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        grid: {
            yaxis: {
                lines: {
                    show: false
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        xaxis: {
            categories: [['Apr'], ['May'], ['June'], ['July'], ['Aug'], ['Sept'], ['Oct']],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        tooltip: {
            theme: 'dark',
            x: {
                format: 'dd/MM/yy HH:mm'
            }
        }
    };
});
const Chart = {
    series: [
        {
            name: '',
            data: [20, 15, 30, 25, 10, 15, 12]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Yearly Sales</v-card-title>
            <v-card-subtitle class="text-subtitle-1 textSecondary">Total Sales</v-card-subtitle>
            <div class="mx-n2">
                <apexchart type="bar" height="310" :options="chartOptions" :series="Chart.series"> </apexchart>
            </div>
            <v-row class="mt-1">
                <v-col cols="6">
                    <div class="d-flex align-center gap-2">
                        <v-avatar class="rounded-md bg-lightprimary text-primary">
                            <GridDotsIcon size="22" />
                        </v-avatar>
                        <div>
                            <p class="text-body-1 textSecondary">Salary</p>
                            <h3 class="text-h6">$36,358</h3>
                        </div>
                    </div>
                </v-col>
                <v-col cols="6" class="d-flex justify-end">
                    <div class="d-flex align-center gap-2">
                        <v-avatar class="rounded-md bg-grey100 textSecondary">
                            <GridDotsIcon size="22" class="text-medium-emphasis" />
                        </v-avatar>
                        <div>
                            <p class="text-body-1 textSecondary">Expance</p>
                            <h3 class="text-h6">$5,296</h3>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-card-item>
    </v-card>
</template>
