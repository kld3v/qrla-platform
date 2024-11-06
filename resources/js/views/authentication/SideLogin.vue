<script setup lang="ts">
import LogoIcon from '@/layouts/full/logo/LogoIcon.vue'
import { Form } from 'vee-validate'

import { ref } from 'vue'
import QRLATITLE from '@/assets/images/QAssets/qrla_green.svg'
import STADIUM_OUTLINE from '@/assets/images/QAssets/stadium_outline.svg'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputError from '@/components/InputError.vue'

const checkbox = ref(false)
const valid = ref(false)
const show1 = ref(false)
const password = ref('')
const username = ref('')
const passwordRules = ref([(v: string) => !!v || 'Password is required', (v: string) => (v && v.length <= 10) || 'Password must be less than 10 characters'])
const emailRules = ref([(v: string) => !!v || 'E-mail is required', (v: string) => /.+@.+\..+/.test(v) || 'E-mail must be valid'])

defineProps<{
	canResetPassword?: boolean
	status?: string
}>()

const form = useForm({
	email: '',
	password: '',
	remember: false,
})

const submit = () => {
	form.post(route('login'), {
		onFinish: () => {
			form.reset('password')
		},
	})
}
</script>

<template>
	<div class="pa-3 h-100vh mh-100">
		<div
			v-if="status"
			class="mb-4 font-medium text-sm text-green-600">
			{{ status }}
		</div>
		<v-row class="h-100vh">
			<v-col
				cols="12"
				lg="5"
				xl="4"
				class="bg-surface auth">
				<div class="d-flex justify-center align-center h-100">
					<div class="mt-xl-0 mt-5 auth-card">
						<LogoIcon />
						<h2 class="text-h3 my-3">Sign in</h2>
						<div class="mb-6">Your Admin Dashboard</div>
						<Form
							class="mt-5"
							@submit="submit">
							<v-label class="font-weight-semibold pb-2 text-white opacity-1"> Email </v-label>
							<VTextField
								v-model="form.email"
								:rules="emailRules"
								class="mb-8 !text-black"
								required
								hide-details="auto" />

							<InputError
								class=""
								:message="form.errors.email" />
							<v-label class="font-weight-semibold pb-2 opacity-1 text-white">Password</v-label>
							<VTextField
								v-model="form.password"
								:rules="passwordRules"
								required
								hide-details="auto"
								type="password"
								class="pwdInput"></VTextField>

							<InputError
								class="mt-2"
								:message="form.errors.password" />
							<div class="d-flex flex-wrap align-center my-3 ml-n2">
								<v-checkbox
									class="pe-2 text-white opacity-1"
									v-model="form.remember"
									:rules="[(v: any) => !!v || 'You must agree to continue!']"
									required
									hide-details
									color="primary">
									<template
										v-slot:label
										class="font-weight-medium text-white"
										>Remember this Device</template
									>
								</v-checkbox>
								<div class="ml-sm-auto">
									<Link
										v-if="canResetPassword"
										:href="route('password.request')"
										class="text-primary text-decoration-none font-weight-medium"
										>Forgot Password ?</Link
									>
								</div>
							</div>
							<v-btn
								size="large"
								:loading="form.processing"
								color="primary"
								:disabled="form.processing"
								block
								type="submit"
								flat
								:class="{ 'opacity-25': form.processing }"
								>Sign In</v-btn
							>
						</Form>
					</div>
				</div>
			</v-col>
			<v-col
				cols="12"
				lg="7"
				xl="8"
				class="d-lg-flex d-none align-center justify-center authentication bg-darkgray position-relative">
				<div class="circle-top"></div>
				<div>
					<img
						class="circle-bottom"
						:src="STADIUM_OUTLINE"
						alt="home" />
				</div>
				<div class="d-flex justify-center align-center w-100 h-n80">
					<v-row class="justify-center z-index-2">
						<v-col
							xl="6"
							lg="7">
							<h1 class="text-h1 text-white lh-normal mb-4">Welcome to</h1>
							<img
								class="ml-[-18px]"
								:src="QRLATITLE"
								alt="qrla title" />
							<p class="text-h6 text-white opacity-80 font-weight-regular mt-4 lh-md">Connecting you to your customers via the physical-digital space.</p>
						</v-col>
					</v-row>
				</div>
			</v-col>
		</v-row>
	</div>
</template>
