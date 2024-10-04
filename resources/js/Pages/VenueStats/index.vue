<script setup lang="ts">
import ProfitCard from '@/components/dashboards/dashboard2/ProfitCard.vue'
import QCard from '@/components/widgets/banners/QCard.vue'
import QIconCard from '@/components/custom/QIconCard.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QFiltering from '@/views/tables/datatables/QFiltering.vue'
import { ref } from 'vue'
import { QCardType } from '@/types'

const props = defineProps({})
const isHome = ref(true)
const card: QCardType = { bg: 'primary-gradient', icon: 'mdi-account-group', title: 'Total Users', dataValue: 299, color: 'primary' }

const cards: QCardType[] = [
	{ bg: 'dark-primary-gradient', icon: 'mdi-account-group', title: 'Total Venues', dataValue: 2, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: 'mdi-account-group', title: 'Total Plaques', dataValue: 450, color: 'warning' },
	{ bg: 'dark-primary-gradient', icon: 'mdi-account-group', title: 'Total Visits', dataValue: 387, color: 'secondary' },
]
</script>
<template>
	<FullLayout :isGlobalHome="false">
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<ProfitCard />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<Q-Card
					:title="$page.props.auth.user.name"
					buttonText="Manage Account" />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<Q-Card
					:title="$page.props.auth.user.name"
					subHeading="Product and Systems Manager" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				v-for="(card, index) in cards"
				:cols="index === 0 ? 6 : 3">
				<QIconCard :card="card" />
			</v-col>
		</v-row>
		<QFiltering />
	</FullLayout>
</template>
