<template>
    <v-card variant="outlined">
        <v-card-item>
            <v-textarea variant="outlined" color="primary" name="input-7-4" placeholder="Share your thoughts" rows="5"></v-textarea>
            <div class="d-flex gap-4">
                
                <v-btn color="inherit" type="upload" variant="plain" class="opacity-1 px-0"> <v-avatar size="32"  class="me-3" color="primary" >
                    <PhotoIcon size="16" />
                </v-avatar>Photo / Video </v-btn>
                <v-btn color="inherit" variant="plain" class="opacity-1 px-0">
                    <v-avatar size="32" color="secondary" class="me-3" >
                        <NotebookIcon size="16" />
                    </v-avatar>
                    Article
                </v-btn>
                <v-btn color="primary" variant="flat" class="ml-auto">Post</v-btn>
            </div>
        </v-card-item>
    </v-card>
</template>
