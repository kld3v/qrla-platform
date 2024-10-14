<script setup lang="ts">
import { computed } from 'vue';
import { getSecondary } from '@/utils/UpdateColors';

/*Chart*/
const chartOptions = computed(() => {
    return {
        chart: {
            type: 'area',
            height: 80,
            fontFamily: `inherit`,
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
            group: 'sparklines'
        },
        colors: [getSecondary.value],
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'solid',
            opacity: 0.05
        },
        markers: {
            size: 0
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
        data: [30, 25, 35, 20, 30, 40]
    }
];
</script>
<template>
    <v-card elevation="10" >
        <v-card-item>
            <p class="text-subtitle-1 textSecondary">Customers</p>
            <h4 class="text-h4 my-2">36,358</h4>
            <div>
                <v-avatar class="bg-lighterror" size="20">
                    <ArrowDownRightIcon size="15" class="text-error" />
                </v-avatar>
                <span class="text-body-1 ml-2 textSecondary">+9%</span>
            </div>
        </v-card-item>
        <apexchart class="" type="area" height="80" :options="chartOptions" :series="Chart"> </apexchart>
    </v-card>
</template>
