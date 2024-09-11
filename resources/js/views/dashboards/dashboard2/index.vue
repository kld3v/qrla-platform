<script setup lang="ts">
import ProfitCard from '@/components/dashboards/dashboard2/ProfitCard.vue';
import SubscriptionCard from '@/components/dashboards/dashboard2/SubscriptionCard.vue';
import UsersChart from '@/components/dashboards/dashboard2/UsersChart.vue';
import RevenueCard from '@/components/dashboards/dashboard2/RevenueCard.vue';
import AnnualProfit from '@/components/dashboards/dashboard2/AnnualProfit.vue';
import NewCustomer from '@/components/dashboards/dashboard2/NewCustomer.vue';
import TotalIncome from '@/components/dashboards/dashboard2/TotalIncome.vue';
import WeeklySchedule from '@/components/dashboards/dashboard2/WeeklySchedule.vue';
import RevenueProducts from '@/components/dashboards/dashboard1/RevenueProducts.vue';
import SalesFromLocation from '@/components/dashboards/dashboard2/SalesFromLocation.vue';
import WeeklyState from '@/components/dashboards/dashboard2/WeeklyState.vue';
import DailyActivities from '@/components/dashboards/dashboard2/DailyActivities.vue';
import ProifileCard from '@/components/dashboards/dashboard2/ProifileCard.vue';
</script>
<template>
    <v-row>
        <!-- Profit card -->
        <v-col cols="12" lg="6">
            <ProfitCard />
        </v-col>
        <v-col cols="12" lg="6">
            <v-row>
                <!-- Subscription -->
                <v-col cols="12" md="6">
                    <SubscriptionCard />
                </v-col>
                <!-- Users -->
                <v-col cols="12" md="6">
                    <UsersChart />
                </v-col>
            </v-row>
        </v-col>
        <!-- Revenue Forecast -->
        <v-col cols="12" lg="8">
            <RevenueCard />
        </v-col>
        <!-- Annual Profit -->
        <v-col cols="12" lg="4">
            <AnnualProfit />
        </v-col>
        <v-col cols="12" lg="4">
            <v-row>
                <!-- New Customers -->
                <v-col cols="12" lg="12" md="6">
                    <NewCustomer />
                </v-col>
                <!-- Total Income -->
                <v-col cols="12" lg="12" md="6">
                    <TotalIncome />
                </v-col>
            </v-row>
        </v-col>
        <!-- Weekly Schedule -->
        <v-col cols="12" lg="8">
            <WeeklySchedule/>
        </v-col>
        <!-- Revenue by Product -->
        <v-col cols="12" lg="8">
            <RevenueProducts/>
        </v-col>
        <!-- Sales from Locations -->
        <v-col cols="12" lg="4">
           <SalesFromLocation/>
        </v-col>
        <!-- Weekly State -->
        <v-col cols="12" lg="4" md="6">
           <WeeklyState/>
        </v-col>
        <!-- Daily activities -->
        <v-col cols="12" lg="4" md="6">
          <DailyActivities/>
        </v-col>
         <!-- Profile Card-->
         <v-col cols="12" lg="4">
            <ProifileCard/>
        </v-col>
    </v-row>
</template>
