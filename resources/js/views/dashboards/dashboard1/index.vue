<script setup lang="ts">
import { ref,onMounted } from 'vue';
import WelcomeCard from '@/components/dashboards/dashboard1/WelcomeCard.vue';
import CustomerCard from '@/components/dashboards/dashboard1/CustomerCard.vue';
import ProjectCard from '@/components/dashboards/dashboard1/ProjectCard.vue';
import RevenueForcast from '@/components/dashboards/dashboard1/RevenueForcast.vue';
import Performence from '@/components/dashboards/dashboard1/Performence.vue';
import CustomerChart from '@/components/dashboards/dashboard1/CustomerChart.vue';
import SalesOverview from '@/components/dashboards/dashboard1/SalesOverview.vue';
import RevenueProducts from '@/components/dashboards/dashboard1/RevenueProducts.vue';
import TotalSettelment from '@/components/dashboards/dashboard1/TotalSettelment.vue';
import SnackBar from '@/components/dashboards/snackbar.vue';

</script>
<template>
    <!-- Loader -->
    <SnackBar/>
    <!-- Loader -->
    
    <v-row>
        <!-- Welcome Cards -->
        <v-col cols="12" lg="5">
            <v-row>
                <v-col cols="12">
                    <WelcomeCard />
                </v-col>
                <v-col cols="12" md="6">
                    <CustomerCard />
                </v-col>
                <v-col cols="12" md="6">
                    <ProjectCard />
                </v-col>
            </v-row>
        </v-col>
        <!-- Revenue Forecast -->
        <v-col cols="12" lg="7">
            <RevenueForcast />
        </v-col>

        <!-- Your Performance -->
        <v-col cols="12" lg="5">
            <Performence />
        </v-col>
        <!-- Customers / Sales Overview -->
        <v-col cols="12" lg="7">
            <v-row>
                <v-col cols="12" md="6">
                    <CustomerChart />
                </v-col>
                <v-col cols="12" md="6">
                    <SalesOverview />
                </v-col>
            </v-row>
        </v-col>
        <!-- Revenue by Product / Total settlements -->
        <v-col cols="12" lg="8">
            <RevenueProducts />
        </v-col>
        <v-col cols="12" lg="4">
           <TotalSettelment/>
        </v-col>
    </v-row>
</template>
