z
<script setup lang="ts">
import ProfitCard from '@/components/dashboards/dashboard2/ProfitCard.vue'
import QCardBanner from '@/components/widgets/banners/QCardBanner.vue'
import QIconCard from '@/components/QComponents/QIconCard.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QFiltering from '@/views/tables/datatables/QFiltering.vue'
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import { ref } from 'vue'
import { QCardType, VenuesTableData } from '@/types'
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'
import QCARDSTADICON from '@/assets/images/svgs/stadium_icon.svg'
import QCARDGRAPHICON from '@/assets/images/svgs/graph_rising.svg'
import { VenuePageProps } from '@/types/Venue'

const props = defineProps<{
	venues: VenuePageProps[]
	stats: any
	nav: 'home'
}>()
const isGlobalHome = ref(true)
console.log(props)
const cards: QCardType[] = [
	{ bg: 'dark-primary-gradient', icon: QCARDSTADICON, title: 'Total Venues', dataValue: props.stats?.total_venues, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: 'mdi-account-group', title: 'Total Plaques', dataValue: props.stats?.total_plaques, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: QCARDGRAPHICON, title: 'Total Visits', dataValue: props.stats?.total_visits, color: 'primary' },
]

const filterVenues = (array: VenuePageProps[]): VenuesTableData[] => {
	return array.map((el) => {
		return {
			venue: el.name,
			type: el.type,
			location: el.city + ', ' + el.country,
			status: el.status,
			action: 'view',
			id: el.id,
		}
	})
}
console.log(filterVenues(props.venues))
</script>
<template>
	<FullLayout
		:isGlobalHome="isGlobalHome"
		:nav="nav">
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
				<QFiltering :venues="filterVenues(props.venues)" />
			</v-col>
		</v-row>
	</FullLayout>
</template>
