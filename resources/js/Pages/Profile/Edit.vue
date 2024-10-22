<script setup lang="ts">
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
import { Head } from '@inertiajs/vue3'
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
import QCARDCOMPANYLOGO from '@/assets/images/QAssets/levy_logo.png'
import QHomePageIntroCard from '@/components/QComponents/QHomePageIntroCard.vue'
import QCardBanner from '@/components/widgets/banners/QCardBanner.vue'
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QCard from '@/components/QComponents/QCard.vue'
import ChangeProfilePhoto from './Partials/ChangeProfilePhoto.vue'

defineProps<{
	mustVerifyEmail?: boolean
	status?: string
	nav: 'account'
}>()

const accountPageComponents: { title: string; subtitle: string; component: keyof typeof componentMap }[] = [
	{ title: 'Change Profile', subtitle: 'Change your profile picture from here.', component: 'ChangeProfilePhoto' },
	{ title: 'Change Password', subtitle: 'To change your password please click here.', component: 'UpdatePasswordForm' },
	{ title: 'Personal Details', subtitle: 'To change your personal details, edit and save from here.', component: 'UpdateProfileInformationForm' },
	{ title: 'Change Company Profile', subtitle: 'Change your company profile picture from here.', component: 'ChangeProfilePhoto' },
]

const componentMap = {
	ChangeProfilePhoto,
	UpdatePasswordForm,
	UpdateProfileInformationForm,
	DeleteUserForm,
}
</script>

<template>
	<Head title="Profile" />
	<FullLayout
		isGlobalHome
		:nav="nav">
		<v-row class="mb-6">
			<v-col
				cols="12"
				lg="6">
				<QHomePageIntroCard />
			</v-col>

			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="$page.props.auth.user.name"
					buttonText="Manage Account"
					:hideButton="true"
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
				cols="12"
				lg="12">
				<QSubsectionHeader title="Account Settings" />
			</v-col>
		</v-row>
		<v-row class="mb-6">
			<v-col
				v-for="(component, index) in accountPageComponents"
				cols="12"
				lg="6">
				<QCard
					bg="dark-primary-gradient"
					custom-css="h-[560px]">
					<h3 class="q-text-qrla_green h3">{{ component.title }}</h3>
					<p class="text-subtitle-1">{{ component.subtitle }}</p>
					<component
						v-bind="{
							index: index,
							componentTitle: component.title,
						}"
						:is="componentMap[component.component]" />
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
