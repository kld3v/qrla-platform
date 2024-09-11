<script setup lang="ts">
import CustomerChart from '@/components/dashboards/dashboard1/CustomerChart.vue';
import Performence from '@/components/dashboards/dashboard1/Performence.vue';
import RevenueProducts from '@/components/dashboards/dashboard1/RevenueProducts.vue';
import SalesOverview from '@/components/dashboards/dashboard1/SalesOverview.vue';
import TotalSettelment from '@/components/dashboards/dashboard1/TotalSettelment.vue';
import AnnualProfit from '@/components/dashboards/dashboard2/AnnualProfit.vue';
import RevenueCard from '@/components/dashboards/dashboard2/RevenueCard.vue';
import Calendarcard from '@/components/dashboards/dashboard3/Calendarcard.vue';
import IconCards from '@/components/dashboards/dashboard3/IconCards.vue';


</script>
<template>
    <v-row>
        <v-col cols="12">
            <IconCards/>
        </v-col>
         <!-- Revenue Forecast -->
         <v-col cols="12" lg="8">
            <RevenueCard />
        </v-col>
        <!-- Annual Profit -->
        <v-col cols="12" lg="4">
            <AnnualProfit />
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

        <v-col cols="12" >
            <Calendarcard/>
        </v-col>
    </v-row>
</template>
