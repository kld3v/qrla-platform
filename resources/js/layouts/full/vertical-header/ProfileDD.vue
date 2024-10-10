<script setup lang="ts">
import { MailIcon } from 'vue-tabler-icons'
import { profileDD } from '@/_mockApis/headerData'
import { Link } from '@inertiajs/vue3'
</script>

<template>
	<!-- ---------------------------------------------- -->
	<!-- notifications DD -->
	<!-- ---------------------------------------------- -->
	<v-menu
		open-on-hover
		open-on-click>
		<template v-slot:activator="{ props }">
			<v-btn
				variant="text"
				class="custom-hover-primary"
				color="primary"
				v-bind="props"
				icon>
				<v-avatar size="35">
					<img
						src="@/assets/images/profile/user-1.jpg"
						width="35"
						alt="Julia" />
				</v-avatar>
			</v-btn>
		</template>
		<v-sheet
			rounded="md"
			width="280"
			elevation="10">
			<div class="pa-6">
				<div class="d-flex align-center pb-6">
					<v-avatar size="55">
						<img
							src="@/assets/images/profile/user-1.jpg"
							width="55" />
					</v-avatar>
					<div class="ml-3">
						<h6 class="text-subtitle-1">{{ $page.props.auth.user.name }}<span class="text-success text-caption"> Pro</span></h6>
						<span class="text-subtitle-1 textSecondary">{{ $page.props.auth.user.email }}</span>
					</div>
				</div>
				<v-divider></v-divider>
				<perfect-scrollbar style="height: calc(100vh - 240px); max-height: 240px">
					<v-list
						class="py-0 theme-list mt-3"
						lines="one">
						<v-list-item
							v-for="item in profileDD"
							:key="item.title"
							class="py-0 px-2 rounded-md custom-text-primary"
							color="primary"
							:to="item.href">
							<div class="d-flex gap-3 align-center">
								<Link
									:href="route(`${item.route}`)"
									class="text-subtitle-1 heading custom-title"
									>{{ item.title }}</Link
								>
								<v-chip
									size="small"
									color="error"
									v-if="item.badge"
									>4</v-chip
								>
							</div>
						</v-list-item>
					</v-list>
				</perfect-scrollbar>
			</div>
		</v-sheet>
	</v-menu>
</template>
