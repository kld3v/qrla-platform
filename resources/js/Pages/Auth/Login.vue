<script setup lang="ts">
import Checkbox from '@/components/Checkbox.vue'
import GuestLayout from '@/layouts/GuestLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

import SideLogin from '@/views/authentication/SideLogin.vue'

defineProps<{
	canResetPassword?: boolean
	status?: string
}>()
</script>

<template>
	<SideLogin
		:can-reset-password="canResetPassword"
		:status="status" />
	<!-- <BoxedLogin /> -->
</template>
