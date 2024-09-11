<script setup lang="ts">
import { computed } from 'vue';
import { Icon } from '@iconify/vue';
import moment from 'moment';
/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            id: 'sparkline3',
            type: 'rangeBar',
            fontFamily: 'inherit',
            foreColor: '#adb0bb',
            height: 300,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                distributed: true,
                dataLabels: {
                    hideOverflowingLabels: false
                }
            }
        },
        dataLabels: {
            enabled: true,
            background: {
                borderRadius: 20
            },
            formatter: function (val: moment.MomentInput[], opts: { w: { globals: { labels: { [x: string]: any; }; }; }; dataPointIndex: string | number; }) {
                var label = opts.w.globals.labels[opts.dataPointIndex];
                var a = moment(val[0]);
                var b = moment(val[1]);
                return label + ': ' + 'Meeting with Sunil';
            }
        },
        xaxis: {
            type: 'datetime',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: { fontSize: '13px', colors: '#adb0bb', fontWeight: '400' }
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: { fontSize: '13px', colors: '#adb0bb', fontWeight: '400' }
            }
        },
        grid: {
            borderColor: 'rgba(0,0,0,0.05)'
        },
        tooltip: {
            theme: 'dark'
        }
    };
});

const Chart = {
    series: [
        {
            data: [
                {
                    x: 'Sun',
                    y: [new Date('2024-02-27').getTime(), new Date('2024-03-04').getTime()],
                    fillColor: 'rgba(var(--v-theme-primary))'
                },
                {
                    x: 'Mon',
                    y: [new Date('2024-03-04').getTime(), new Date('2024-03-10').getTime()],
                    fillColor: 'rgba(var(--v-theme-grey200),0.8)'
                },
                {
                    x: 'Tue',
                    y: [new Date('2024-03-01').getTime(), new Date('2024-03-06').getTime()],
                    fillColor: 'rgba(var(--v-theme-error))'
                }
            ]
        }
    ]
};
</script>
<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Weekly Scheduels</v-card-title>
            <apexchart type="rangeBar" class="rounded-pill-bars" height="300" :options="chartOptions" :series="Chart.series"> </apexchart>
        </v-card-item>
    </v-card>
</template>
