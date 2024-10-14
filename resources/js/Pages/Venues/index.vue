<script setup lang="ts">
import ProfitCard from '@/components/dashboards/dashboard2/ProfitCard.vue'
import QCardBanner from '@/components/widgets/banners/QCardBanner.vue'
import QIconCard from '@/components/QComponents/QIconCard.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QFiltering from '@/views/tables/datatables/QFiltering.vue'
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import { ref } from 'vue'
import { QCardType } from '@/types'
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'
import QCARDSTADICON from '@/assets/images/svgs/stadium_icon.svg'
import QCARDGRAPHICON from '@/assets/images/svgs/graph_rising.svg'

const props = defineProps<{

}>()
const isGlobalHome = ref(true)
// console.log(props)
const cards: QCardType[] = [
	{ bg: 'dark-primary-gradient', icon: QCARDSTADICON, title: 'Total Venues', dataValue: 2, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: 'mdi-account-group', title: 'Total Plaques', dataValue: 450, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: QCARDGRAPHICON, title: 'Total Visits', dataValue: 387, color: 'primary' },
]
</script>
<template>
	<FullLayout :isGlobalHome="isGlobalHome">
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<ProfitCard />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="$page.props.auth.user.name"
					buttonText="Manage Account"
					:imageSrc="QCARDAVATAR" />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="$page.props.auth.user.name"
					subHeading="Product and Systems Manager"
					:imageSrc="QCARDCOMPANYLOGO" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				v-for="(card, index) in cards"
				:cols="index === 0 ? 6 : 3">
				<QIconCard :card="card" />
			</v-col>
		</v-row>
		<v-row class="">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Your Venues" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QFiltering />
			</v-col>
		</v-row>
	</FullLayout>
</template>
