<script setup lang="ts">
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user
const organisation = usePage().props.organisation

const form = useForm({
    name: user.name,
    email: user.email,
    organisationName: organisation.name,
    role: user.role,
    location: organisation.address_line1 + ', ' + organisation.city + ', ' + organisation.country,
    phone: user.phone,
})

const submitForm = () => {
    form.patch(route('profile.update'), {
        onError: () => {
            // Not sure how we want to error handle
        },
        onSuccess: () => {
            // Not sure if we need any success
        }
    })
}
</script>

<template>
    <section>
        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6">
            <div class="grid grid-cols-2 gap-x-4">
                <!-- Name Field -->
                <div>
                    <InputLabel
                        for="name"
                        value="Name" />

                    <v-text-field
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.name" />
                </div>

                <!-- Organisation Name Field (Read-Only) -->
                <div>
                    <InputLabel
                        for="organisationName"
                        value="Organisation Name" />

                    <v-text-field
                        id="organisationName"
                        type="text"
                        class="mt-1 block w-full text-gray-500"
                        v-model="form.organisationName"
                        readonly
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.organisationName" />
                </div>

                <!-- Role Field -->
                <div>
                    <InputLabel
                        for="role"
                        value="Role" />

                    <v-text-field
                        id="role"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.role"
                        required
                        autocomplete="role" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.role" />
                </div>

                <!-- Location Field (Read-Only) -->
                <div>
                    <InputLabel
                        for="location"
                        value="Location" />

                    <v-text-field
                        id="location"
                        type="text"
                        class="mt-1 block w-full text-gray-500"
                        v-model="form.location"
                        readonly
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.location" />
                </div>

                <!-- Phone Field -->
                <div>
                    <InputLabel
                        for="phone"
                        value="Phone" />

                    <v-text-field
                        id="phone"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        required
                        autocomplete="tel" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.phone" />
                </div>

                <!-- Email Field -->
                <div>
                    <InputLabel
                        for="email"
                        value="Email" />

                    <v-text-field
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username" />

                    <InputError
                        class="mt-2"
                        :message="form.errors.email" />
                </div>
            </div>

            <!-- Verification Notice -->
            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex items-center gap-4">
                <v-btn
                    color="primary"
                    :disabled="form.processing"
					@click="submitForm"
                    >Save</v-btn
                >

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600">
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

