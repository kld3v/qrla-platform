<script setup lang="ts"></script>
<template>
    <div class="pt-16 overflow-hidden bg-light">
        <v-container>
            <div class="maxWidth">
                <v-row>
                    <v-col cols="12" lg="6" md="12" class="d-flex align-center">
                        <div class="mt-8 mt-lg-0 py-8 pb-0">
                            <span class="text-h6 heading d-flex align-center gap-2" data-aos="fade-up" data-aos-duration="400"
                                ><RocketIcon size="18" class="text-secondary" /> Kick start your project with</span
                            >
                            <h1 class="bannerTitle pt-5 font-weight-bold" data-aos="fade-up" data-aos-duration="500">
                                Enhance <span class="text-primary">Developer's Productivity</span> with a MatDash
                            </h1>
                            <p class="pt-8 pb-6 text-h5 textPrimary font-weight-regular" data-aos="fade-up" data-aos-duration="800">
                                MatDash comes with light & dark color skins, well designed dashboards, applications and pages.
                            </p>
                            <div class="mt-6 d-sm-flex gap-3" data-aos="fade-up" data-aos-duration="1000">
                                <v-btn target="_blank" href="/auth/login2" color="primary" size="large" class="m-btn-full px-12" flat
                                    >Login</v-btn
                                >
                                <v-btn
                                    to=""
                                    v-scroll-to="'#demos'"
                                    color="primary"
                                    variant="outlined"
                                    class="mt-sm-0 mt-4 lp-btn-shadow m-btn-full px-8"
                                    size="large"
                                    >Live Preview</v-btn
                                >
                            </div>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6" class="d-none d-lg-block pb-0">
                        <div class="bannerSlider">
                            <div class="d-flex flex-row">
                                <div class="rounded-md">
                                    <div class="animateUp">
                                        <img src="@/assets/images/landingpage/bannerimg1.png" />
                                    </div>
                                    <div class="animateUp">
                                        <img src="@/assets/images/landingpage/bannerimg1.png" />
                                    </div>
                                </div>
                                <div class="rounded-md">
                                    <div class="animateDown">
                                        <img src="@/assets/images/landingpage/bannerimg2.png" />
                                    </div>
                                    <div class="animateDown">
                                        <img src="@/assets/images/landingpage/bannerimg2.png" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-container>
    </div>
</template>
