<script setup lang="ts">
import { ref } from 'vue'
import { VenuesTableData } from '@/types'
import { Link } from '@inertiajs/vue3'

const filterable = ref('')
const props = defineProps<{
	venues: VenuesTableData[]
}>()
const align = 'start'
const headers = ref([
	{ title: 'Venue', value: 'venue' },
	{ title: 'Type', value: 'type' },
	{ title: 'Location', value: 'location' },
	{ title: 'Status', value: 'status' },
	{ title: 'Action', value: 'action' },
])
</script>
<template>
	<v-card
		style="padding: 24px"
		class="default-gray"
		flat>
		<v-card-title class="d-flex align-center px-0 pb-3">
			<v-text-field
				v-model="filterable"
				prepend-inner-icon="mdi-magnify"
				label="Search"
				id="venues-filter-table"
				class="search"></v-text-field>
			<v-spacer></v-spacer>
		</v-card-title>

		<v-data-table
			v-model:search="filterable"
			class="default-gray"
			:items="venues"
			:headers="headers"
			hover>
			<!-- <template v-slot:item.image="{ item }">
							<v-card
								class="my-2"
								elevation="2">
								<v-img
									:src="`${item.image}`"
									height="80"
									class="rounded-md"
									cover></v-img>
							</v-card>
						</template> -->

			<template v-slot:item.venue="{ item }">
				<div>
					{{ item.venue }}
				</div>
			</template>
			<template v-slot:item.type="{ item }">
				<div class="muted">
					{{ item.type }}
				</div>
			</template>
			<template v-slot:item.location="{ item }">
				<div class="muted">
					{{ item.location }}
				</div>
			</template>
			<template v-slot:item.status="{ item }">
				<div>
					<v-chip
						:color="item.status === 'Active' ? 'success' : 'error'"
						:text="item.status === 'Active' ? 'Active' : 'Inactive'"
						class="text-uppercase"
						label
						size="small"></v-chip>
				</div>
			</template>
			<template v-slot:item.action="{ item }">
				<Link :href="`/venues/${item.id}`">
					<v-btn
						color="primary"
						class="text-24 mr-3"
						>{{ item.action }}</v-btn
					>
				</Link>
			</template>
		</v-data-table>
	</v-card>
</template>
<style>
.default-gray {
	background-color: rgba(var(--v-theme-darkdefaultgray));
}

.muted {
	color: rgba(var(--v-theme-muted));
}
</style>
