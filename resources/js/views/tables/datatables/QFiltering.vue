<script setup lang="ts">
import { ref } from 'vue'
import BaseBreadcrumb from '@/components/shared/BaseBreadcrumb.vue'
import UiParentCard from '@/components/shared/UiParentCard.vue'
import { BasicDatatables, UppercaseFilter } from '@/_mockApis/components/datatable/dataTable'
import { VenuesTableData } from '@/types'

const filterable = ref('')
const venues = ref<VenuesTableData[]>([
	{ venue: 'Stanford', type: 'sports', location: 'London, UK', status: 'active', actions: ['view', 'delete'] },
	{ venue: 'Stanford', type: 'sports', location: 'London, UK', status: 'active', actions: ['view', 'delete'] },
	{ venue: 'Wembley', type: 'sports', location: 'London, UK', status: 'active', actions: ['view', 'delete'] },
	{ venue: 'Stanford', type: 'sports', location: 'London, UK', status: 'active', actions: ['view', 'delete'] },
	{ venue: 'Stanford', type: 'sports', location: 'London, UK', status: 'active', actions: ['view', 'delete'] },
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
				density="compact"
				label="Search"
				single-line
				variant="outlined"></v-text-field>
			<v-spacer></v-spacer>
		</v-card-title>

		<v-data-table
			v-model:search="filterable"
			class="default-gray"
			:items="venues"
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
						:color="item.status === 'active' ? 'success' : 'error'"
						:text="item.status === 'active' ? 'Active' : 'Inactive'"
						class="text-uppercase"
						label
						size="small"></v-chip>
				</div>
			</template>
			<template v-slot:item.actions="{ item }">
				<div>
					<v-icon
						color="#635BFF"
						class="text-24 mr-3"
						>mdi-eye</v-icon
					>
					<v-icon
						color="#29343D"
						class="text-24"
						>mdi-delete</v-icon
					>
				</div>
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

.search {
	color: white;
	background-color: #041522 !important;
}
</style>
