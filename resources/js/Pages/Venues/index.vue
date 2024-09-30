<script setup lang="ts">
import ProfitCard from '@/components/dashboards/dashboard2/ProfitCard.vue'
import QCard from '@/components/widgets/banners/Q-Card.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import { ref } from 'vue'

const props = defineProps({})
const isHome = ref(true)
</script>
<template>
	<FullLayout>
		<v-row>
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
	</FullLayout>
</template>
