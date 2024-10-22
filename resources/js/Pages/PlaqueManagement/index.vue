<script setup lang="ts">
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import HeaderImageAndLogo from '@/components/QComponents/HeaderImageAndLogo.vue'
import { computed, ref, watch } from 'vue'
import { VenuePageProps } from '@/types/Venue'
import VenueTitleAndAddress from '@/components/QComponents/VenueTitleAndAddress.vue'
import QCard from '@/components/QComponents/QCard.vue'
import QPRIVACYASSET from '@/assets/images/QAssets/PlaqueManagement/privacy_asset.svg'
import QSETTINGASSET from '@/assets/images/QAssets/PlaqueManagement/settings_asset.svg'
import { BlockExtended, NavOptions, Stand } from '@/types'
import QMenusAnchor from '@/components/QComponents/QMenusAnchor.vue'
import QSelectableTable from '@/components/QComponents/QSelectableTable.vue'
import QInteractiveVenueMap from '@/components/QComponents/QInteractiveVenueMap.vue'
import QModal from '@/components/QComponents/QModal.vue'
const props = defineProps<{
	venue: VenuePageProps
	stands: Stand[]
	nav: NavOptions
}>()

console.log(props)

const selectedStand = ref<Stand>(props.stands[0])

const changeSelectedStand = (standName: string) => {
	for (const stand of props.stands) {
		if (standName === stand.name) {
			selectedStand.value = stand
			console.log('Stand Updated')
			return
		}
	}
}

const selectedBlocks = ref<BlockExtended[]>([props.stands[0].blocks[2]])

const updateSelectedBlockState = (blocks: BlockExtended[]) => {
	selectedBlocks.value = blocks
	console.log('new Mr Selected Blocks', selectedBlocks.value)
}

const returnSelectedStandBlocksForTable = computed(() => selectedStand.value.blocks.map((el: BlockExtended) => el))
</script>

<template>
	<FullLayout
		:is-global-home="false"
		:venue="venue"
		:nav="nav">
		<HeaderImageAndLogo
			:bannerUrl="venue.banner_url"
			:logoUrl="venue.logo_url"
			class="mb-6" />
		<VenueTitleAndAddress
			:name="venue.name"
			:address-line1="venue.address_line1"
			:city="venue.city"
			class="mb-12" />
		<v-row class="mb-3">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Select Your Blocks" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QCard bg="default-gray">
					<div class="flex justify-space-between align-center w-full">
						<div class="mb-4">
							<h3 class="q-text-qrla_green h3 mb-2">Select Block End Destination URL To Edit</h3>
						</div>
						<QMenusAnchor
							:changeSelectedStand="changeSelectedStand"
							:label="'Stand'"
							menu-location="start"
							dropdown-button-color="secondary"
							:initialSelectedItem="selectedStand.name"
							:dropdown-options="[...props.stands.map((el: Stand) => el.name)]"></QMenusAnchor>
					</div>
					<v-row>
						<v-col
							cols="12"
							lg="4">
							<QCard bg="dark-primary-gradient">
								<QSelectableTable
									:selected-blocks="selectedBlocks"
									:update-selected-block-state="updateSelectedBlockState"
									:block-data="returnSelectedStandBlocksForTable"
									select-strategy="single" />
							</QCard>
						</v-col>
						<v-col
							cols="12"
							lg="6">
							<QInteractiveVenueMap
								:updateSelectedBlockState="updateSelectedBlockState"
								:svgUrl="venue.map_svg_url"
								:stands="stands"
								:selected-blocks="selectedBlocks" />
						</v-col>
					</v-row>
				</QCard>
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="12">
				<QSubsectionHeader title="Manage Your Plaques" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="flex flex-col align-center justify-center gap-4">
						<img
							:src="QSETTINGASSET"
							alt="Edit Settings Icon" />
						<h3 class="h3 q-text-qrla_green">Change Link Destination</h3>
						<p>Dynamically edit the end URL of the QRLA plaque.</p>
						<QModal
							button-text="Change"
							:total-steps="2">
							<template #page-0>
								<v-row class="mb-6">
									<v-col
										cols="12"
										lg="12">
										<QCard bg="default-gray">
											<div class="flex justify-space-between align-center w-full">
												<div class="mb-4">
													<h3 class="q-text-qrla_green h3 mb-2">Select Block End Destination URL To Edit</h3>
												</div>
												<QMenusAnchor
													:changeSelectedStand="changeSelectedStand"
													:label="'Stand'"
													menu-location="start"
													dropdown-button-color="secondary"
													:initialSelectedItem="selectedStand.name"
													:dropdown-options="[...props.stands.map((el: Stand) => el.name)]"></QMenusAnchor>
											</div>
											<v-row>
												<v-col
													cols="12"
													lg="4">
													<QCard bg="dark-primary-gradient">
														<QSelectableTable
															:update-selected-block="changeSelectedBlock"
															:block-data="returnSelectedStandBlocksForTable"
															select-strategy="all" />
													</QCard>
												</v-col>
												<v-col
													cols="12"
													lg="6">
													<QInteractiveVenueMap
														:svgUrl="venue.map_svg_url"
														:stands="stands"
														:selected-block="selectedBlock" />
												</v-col>
											</v-row>
										</QCard>
									</v-col>
								</v-row>
							</template>
							<template #page-1>
								<v-row class="mb-6">
									<v-col
										cols="12"
										lg="12">
										<QCard bg="default-gray">
											<div class="flex justify-space-between align-center w-full">
												<div class="mb-4">
													<h3 class="q-text-qrla_green h3 mb-2">Select Block End Destination URL To Edit</h3>
												</div>
												<QMenusAnchor
													:changeSelectedStand="changeSelectedStand"
													:label="'Stand'"
													menu-location="start"
													dropdown-button-color="secondary"
													:initialSelectedItem="selectedStand.name"
													:dropdown-options="[...props.stands.map((el: Stand) => el.name)]"></QMenusAnchor>
											</div>
											<v-row>
												<v-col
													cols="12"
													lg="4">
													<QCard bg="dark-primary-gradient">
														<QSelectableTable
															:update-selected-block="changeSelectedBlock"
															:block-data="returnSelectedStandBlocksForTable"
															select-strategy="all" />
													</QCard>
												</v-col>
												<v-col
													cols="12"
													lg="6">
													<v-text-field />
												</v-col>
											</v-row>
										</QCard>
									</v-col>
								</v-row>
							</template>
						</QModal>
					</div>
				</QCard>
			</v-col>
			<v-col
				cols="12"
				lg="6">
				<QCard bg="default-gray">
					<div class="flex flex-col align-center justify-center gap-4">
						<img
							:src="QPRIVACYASSET"
							alt="Edit Verification Icon" />
						<h3 class="h3 q-text-qrla_green">Edit Verification Page</h3>
						<p>Redesign the QRLA safety page by uploading a new brand logo.</p>
						<v-btn
							disabled
							class="q-btn-green"
							>Coming Soon</v-btn
						>
					</div>
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
