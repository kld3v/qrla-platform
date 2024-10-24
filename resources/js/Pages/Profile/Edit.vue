<script setup lang="ts">
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
import { Head, usePage } from '@inertiajs/vue3' // Import usePage
import QHomePageIntroCard from '@/components/QComponents/QHomePageIntroCard.vue'
import QCardBanner from '@/components/widgets/banners/QCardBanner.vue'
import QSubsectionHeader from '@/components/QComponents/QSubSectionHeader.vue'
import FullLayout from '@/layouts/full/FullLayout.vue'
import QCard from '@/components/QComponents/QCard.vue'
import ChangeProfilePhoto from './Partials/ChangeProfilePhoto.vue'
import QCARDAVATAR from '@/assets/images/profile/user-1.jpg'
import { Organisation } from '@/types/Venue'

// Access the $page props with usePage()

const props = defineProps<{
	auth: any
	organisation: Organisation
	mustVerifyEmail?: boolean
	status?: string
	nav: 'account'
}>()
console.log(props)

const accountPageComponents: { title: string; subtitle: string; component: keyof typeof componentMap; props?: object }[] = [
	{
		title: 'Change Profile',
		subtitle: 'Change your profile picture from here.',
		component: 'ChangeProfilePhoto',
		props: {
			endpoint: route('user.uploadProfilePhoto'),
			defaultImage: props.auth.user.profile_photo_url || QCARDAVATAR,
		},
	},
	{
		title: 'Change Password',
		subtitle: 'To change your password please click here.',
		component: 'UpdatePasswordForm',
	},
	{
		title: 'Personal Details',
		subtitle: 'To change your personal details, edit and save from here.',
		component: 'UpdateProfileInformationForm',
	},
	{
		title: 'Change Company Profile',
		subtitle: 'Change your company profile picture from here.',
		component: 'ChangeProfilePhoto',
		props: {
			endpoint: route('organisation.uploadLogo'),
			defaultImage: props.organisation.logo_path,
		},
	},
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
					:title="props.auth.user.name"
					buttonText="Manage Account"
					:hideButton="true"
					:imageSrc="props.auth.user.profile_photo_url || QCARDAVATAR" />
			</v-col>
			<v-col
				cols="12"
				lg="3">
				<QCardBanner
					:title="props.organisation.name"
					subHeading="Product and Systems Manager"
					:imageSrc="props.organisation.logo_path" />
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
				:cols="12"
				:lg="6"
				:key="index">
				<QCard
					bg="dark-primary-gradient"
					custom-css="h-[560px]">
					<h3 class="q-text-qrla_green h3">{{ component.title }}</h3>
					<p class="text-subtitle-1">{{ component.subtitle }}</p>
					<component
						v-bind="{
							index: index,
							componentTitle: component.title,
							...component.props,
							auth,
						}"
						:is="componentMap[component.component]" />
				</QCard>
			</v-col>
		</v-row>
	</FullLayout>
</template>
