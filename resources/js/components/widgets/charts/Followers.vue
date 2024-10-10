<script setup lang="ts">
import { computed } from 'vue';
import { useTheme } from 'vuetify';
const theme = useTheme();
const primary = theme.current.value.colors.primary;
/* Chart */
const chartOptions = computed(() => {
    return {
        chart: {
            type: 'area',
            fontFamily: `inherit`,
            foreColor: '#adb0bb',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
            group: 'sparklines'
        },
        colors: [primary],
        stroke: {
           curve: 'smooth',
           width: 2
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
            name:'',
            data: [0, 150, 110, 240, 200, 200, 300, 200],
        }
    ]
};
</script>
<template>
    <v-card elevation="10" class="overflow-hidden">
        <v-card-item>
            <div class="d-flex justify-space-between align-end">
                <div>
                    <v-card-title class="text-h5">2,545</v-card-title>
                    <v-card-subtitle class="text-subtitle-1 pb-0">Followers</v-card-subtitle>
                </div>
                <p class="text-subtitle-1 text-success">+1.20%</p>    
            </div>
        </v-card-item>
        <apexchart class="mt-4" type="area" height="88" :options="chartOptions" :series="Chart.series"> </apexchart>
    </v-card>
</template>
