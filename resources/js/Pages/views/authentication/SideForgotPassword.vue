<script setup lang="ts">
import LogoIcon from '@/layouts/full/logo/LogoIcon.vue';
/* Reset form */
import ResetPassword from '@/components/auth/ResetForm.vue';
</script>

<template>
    <div class="pa-3">
        <v-row class="h-100vh mh-100">
            <v-col cols="12" lg="5" xl="4" class="bg-surface auth">
                <div class="d-flex justify-center align-center h-100">
                    <div class="mt-xl-0 mt-5 auth-card">
                        <LogoIcon />
                        <h2 class="text-h3 my-3 heading">Forgot your password?</h2>
                    <p class="text-subtitle-1 textSecondary">
                        Please enter the email address associated with your account and We will email you a link to reset your password.
                    </p>
                    <ResetPassword />
                    <v-btn size="large" color="lightprimary" to="/auth/login" block class="mt-5 text-primary" flat>Back to Login</v-btn>
                </div>
            </div>
            </v-col>
            <v-col cols="12" lg="7" xl="8" class="d-lg-flex d-none align-center justify-center authentication bg-darkgray position-relative">
                <div class="circle-top"></div>
                <div>
                    <LogoIcon class="circle-bottom" />
                </div>
                <div class="d-flex justify-center align-center w-100 h-n80">
                    <v-row class="justify-center z-index-2">
                        <v-col xl="6" lg="7">
                            <h1 class="text-h1 text-white lh-normal">
                                Welcome to
                                <br />
                                MatDash
                            </h1>
                            <p class="text-h6 text-white opacity-80 font-weight-regular mt-4 lh-md">
                                MatDash helps developers to build organized and well<br />
                                coded dashboards full of beautiful and rich modules.
                            </p>
                            <v-btn to="/" size="large" color="primary" class="mt-5"> Learn More </v-btn>
                        </v-col>
                    </v-row>
                </div>
            </v-col>
        </v-row>
    </div>
</template>
