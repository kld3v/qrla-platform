<script setup>
import { SalesFromLocationData } from '@/_mockApis/components/dashboard/dashboard2';
import svgMap from 'svgmap';
import 'svgmap/dist/svgMap.min.css';
import { onMounted, ref } from 'vue';
const map = ref(null);

onMounted(() => {
    new svgMap({
        targetElementID: 'svgMap',
        mouseWheelZoomEnabled: false,
        hideFlag: true,
        initialZoom: 1.23,

        data: {
            data: {
                countresidents: {
                    format: '{0}',
                    thousandSeparator: ',',
                    thresholdMax: 50000,
                    thresholdMin: 1000
                }
            },
            applyData: 'countresidents',
            values: {
                AF: { countresidents: 587, color: 'rgba(var(--v-theme-error))' },
                IN: { countresidents: 232, color: 'rgba(var(--v-theme-primary))' },
                US: { countresidents: 42393, color: 'rgba(var(--v-theme-secondary))' }
            }
        }
    });
});
</script>

<template>
    <v-card elevation="10">
        <v-card-item>
            <v-card-title class="text-h5">Sales from Locations</v-card-title>
            <v-card-subtitle class="text-subtitle-1">World Map</v-card-subtitle>
            <div id="svgMap" ref="map" class="mt-7 mb-4"></div>
            <v-row v-for="item in SalesFromLocationData" :key="item.name" class="align-center justify-space-between mt-1">
                <v-col cols="2" xl="auto" lg="3" sm="2">
                    <h6 class="text-textPrimary text-body-1">{{ item.name }}</h6>
                </v-col>
                <v-col cols="7" xl="8" lg="6" class="px-0"
                    ><v-progress-linear
                        :model-value="item.percentage"
                        height="7"
                        :bg-color="'light' + item.color"
                        :color="item.color"
                        rounded
                    ></v-progress-linear
                ></v-col>
                <v-col cols="3" xl="auto" lg="3" sm="3" class="text-end">
                    <h6 class="text-grey200 text-body-1">{{ item.percentage }}</h6>
                </v-col>
            </v-row>
        </v-card-item>
    </v-card>
</template>

<style lang="scss">
.svgMap-map-wrapper {
    background: transparent;
    padding-top: 70%;
    top: -20px;
}

.svgMap-map-wrapper {
    .svgMap-country {
        stroke: #fff;
        fill: #c9d6de !important;

        &#svgMap-map-country-IN {
            fill: rgb(var(--v-theme-primary)) !important;
        }

        &#svgMap-map-country-AF {
            fill: rgb(var(--v-theme-error)) !important;
        }

        &#svgMap-map-country-US {
            fill: rgb(var(--v-theme-secondary)) !important;
        }
    }

    .svgMap-map-controls-zoom {
        background: #c9d6de !important;
        .svgMap-control-button.svgMap-zoom-button:before {
            width: 9px !important;
            height: 2px !important;
        }
        .svgMap-control-button.svgMap-zoom-in-button:after {
            width: 2px !important;
            height: 10px !important;
        }
    }
    .svgMap-control-button{
        height: 20px;
        width: 20px;
    }
}
</style>
