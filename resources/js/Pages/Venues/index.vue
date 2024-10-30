<script setup lang="ts">
import QPageIntroCard from '@/components/QComponents/QHomePageIntroCard.vue'
import QCardBanner from '@/components/widgets/banners/QCardBanner.vue'
import QIconCard from '@/components/QComponents/QIconCard.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QFiltering from '@/views/tables/datatables/QFiltering.vue'
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'

import { QCardType, User, VenuesTableData } from '@/types'
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'
import QCARDSTADICON from '@/assets/images/svgs/stadium_icon_dark.svg'
import QCARDGRAPHICON from '@/assets/images/svgs/graph_rising.svg'
import QCARDQRLALOGO from '@/assets/images/QAssets/Venues/qrla_logo.svg'
import { VenuePageProps } from '@/types'
import { formatNumberWithCommas } from '@/utils/helpers/numbers'

const props = defineProps<{
	venues: VenuePageProps[]
	stats: any
	nav: 'home'
	auth: { user: User }
}>()

const cards: QCardType[] = [
	{ bg: 'dark-primary-gradient', icon: QCARDSTADICON, title: 'Total Venues', dataValue: props.stats?.total_venues, color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: QCARDQRLALOGO, title: 'Total Plaques', dataValue: formatNumberWithCommas(props.stats?.total_plaques), color: 'primary' },
	{ bg: 'dark-primary-gradient', icon: QCARDGRAPHICON, title: 'Total Visits', dataValue: formatNumberWithCommas(props.stats?.total_visits), color: 'primary' },
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
</script>
<template>
	<FullLayout
		isGlobalHome
		:nav="nav">
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QPageIntroCard />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="$page.props.auth.user.name"
					buttonText="Manage Account"
					:imageSrc="$page.props.auth.user.profile_photo_url || QCARDAVATAR" />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="$page.props.auth.user.name"
					subHeading="Product and Systems Manager"
					:imageSrc="auth.user.organisation?.logo_path || QCARDCOMPANYLOGO" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				v-for="(card, index) in cards"
				:cols="12"
				:md="index === 0 ? 6 : 3">
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
