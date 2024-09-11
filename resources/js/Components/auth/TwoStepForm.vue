<template>
    <div class="mt-6">
        <v-label class="text-subtitle-1 font-weight-semibold pb-2 text-lightText">Type your 6 digits security code</v-label>
        <div class="d-flex justify-space-between gap-3 mb-2 verification">
            <VTextField></VTextField>
            <VTextField></VTextField>
            <VTextField></VTextField>
            <VTextField></VTextField>
            <VTextField></VTextField>
            <VTextField></VTextField>
        </div>
        <v-btn color="darkgray" size="large" block flat>Verify My Account</v-btn>
        <h6 class="text-16 text-medium-emphasis d-flex align-center mt-6"   >
            Didn't get the code?
            <RouterLink to="/" class="pl-0 text-primary text-16 opacity-1 pl-2 text-decoration-none"> Resend</RouterLink>
        </h6>
    </div>
</template>