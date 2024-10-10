<script setup lang="ts">
import Logo from '@/layouts/full/logo/Logo.vue';
/* Reset form */
import ResetPassword from '@/components/auth/ResetForm.vue';
import { AuthCuroselData } from '@/_mockApis/components/pages/auth';
</script>

<template>
    <div class="authentication auth-bg">
        <v-container class="pa-3 auth-login">
            <v-row class="h-100vh d-flex justify-center align-center">
                <v-col cols="12" class="d-flex align-center">
                    <v-card rounded="md" elevation="10" class="mx-auto">
                        <div class="pa-3">
                            <v-row>
                                <v-col cols="12" md="6" class="border-e px-md-12 px-6 py-md-12 py-6">
                                    <div class="my-5"><Logo /></div>
                                    <p class="text-body-1 textSecondary">
                                        Please enter the email address associated with your account and We will email you a link to reset
                                        your password.
                                    </p>
                                    <ResetPassword />
                                    <v-btn size="large" color="lightprimary" to="/auth/login2" block class="mt-5 text-primary" flat
                                        >Back to Login</v-btn
                                    >
                                </v-col>
                                <v-col cols="12" md="6" class="d-md-flex justify-center d-none">
                                    <div class="d-flex flex-column justify-center px-md-12 px-6 h-100 align-center">
                                        <div>
                                            <img src="@/assets/images/backgrounds/login-side.png" alt="matdash-img" width="200" />
                                        </div>

                                        <v-carousel
                                            :continuous="false"
                                            :show-arrows="false"
                                            cycle
                                            height="150"
                                            hide-delimiter-background
                                            class="text-center mt-4"
                                        >
                                            <v-carousel-item v-for="item in AuthCuroselData" :key="item.title">
                                                <h3 class="text-h3 mb-0">{{ item.title }}</h3>
                                                <v-btn color="primary" class="mt-4" flat>Learn More</v-btn>
                                            </v-carousel-item>
                                        </v-carousel>
                                    </div>
                                </v-col>
                            </v-row>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
