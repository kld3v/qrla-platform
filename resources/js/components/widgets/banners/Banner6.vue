<template>
    <v-card elevation="10" class=" mt-6">
        <v-card-item class="text-center">
            <h5 class="text-h5 mb-6">Mutual Friend Revealed</h5>
                <v-badge content="1" color="error"  
                    offset-x="18"
                    offset-y="18"
                >
                    <v-avatar size="140">
                        <img src="@/assets/images/profile/user-3.jpg" height="140" alt="image" />    
                    </v-avatar>
                </v-badge>
            
                <h5 class="text-h5 pt-3 mt-3 mb-0">Tommoie Henderson</h5>
            <p class="text-body-1 mt-3 textSecondary">
              Accept the request and<br> type a message
            </p>
            <div class="d-flex justify-center gap-3 mt-4">
                <v-btn flat color="primary" size="large">accept</v-btn>
            <v-btn flat variant="tonal"  size="large"  color="error">remove</v-btn>
            </div>
          
        </v-card-item>
    </v-card>
</template>
