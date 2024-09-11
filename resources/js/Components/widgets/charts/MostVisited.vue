<script setup lang="ts">
import { ref } from 'vue';
import { computed } from 'vue';
import { useTheme } from 'vuetify';
const select = ref('March 2022');
const items = ref(['March 2022', 'April 2022', 'May 2022']);
const theme = useTheme();
const primary = theme.current.value.colors.primary;
const secondary = theme.current.value.colors.secondary;

/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            height: 265,
            type: 'bar',
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            toolbar: {
                show: false
            },
            stacked: true
        },
        colors: [primary, secondary],
        plotOptions: {
            bar: {
                borderRadius: [6],
                horizontal: false,
                barHeight: '60%',
                columnWidth: '40%',
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            }
        },
        stroke: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        grid: {
            show: false,
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        yaxis: {
            tickAmount: 4
        },
        xaxis: {
            categories: ['01', '02', '03', '04', '05', '06'],
            axisTicks: {
                show: false
            }
        },
        tooltip: {
            theme: 'dark',
            fillSeriesColor: false,
            x: {
                show: false
            }
        }
    };
});
const Chart = [
    {
        name: 'San Francisco',
        data: [44, 55, 41, 67, 22, 43]
    },
    {
        name: 'Diego',
        data: [13, 23, 20, 8, 13, 27]
    }
];
</script>

<template>
    <v-card elevation="10">
        <v-card-item>
            <div class="d-sm-flex align-center justify-space-between">
                <v-card-title class="text-h5 mb-0">Most Visited</v-card-title>
                <div class="my-sm-0 my-2">
                    <v-select
                        v-model="select"
                        :items="items"
                        class="text-body-1"
                        variant="outlined"
                        density="compact"
                        hide-details
                    ></v-select>
                </div>
            </div>
            <div class="mx-n3 mt-5">
                <apexchart type="bar" height="265" class="rounded-bars" :options="chartOptions" :series="Chart"> </apexchart>      
            </div>
           
            <div class="d-flex align-center pb-1 justify-center">
                <p class="text-body-1 textSecondary d-flex align-center">
                    <v-icon icon="mdi mdi-checkbox-blank-circle" class="mr-2" size="10" color="primary"></v-icon> San Francisco
                </p>
                <p class="text-body-1 textSecondary pl-5 d-flex align-center">
                    <v-icon icon="mdi mdi-checkbox-blank-circle" class="mr-2" size="10" color="secondary"></v-icon> Diego
                </p>
            </div>
        </v-card-item>
    </v-card>
</template>
