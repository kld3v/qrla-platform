<template>
  <div class="flex align-center justify-center h-[90%]">
    <div class="flex flex-col justify-space-between align-center w-full h-[300px]">
      <v-avatar
        v-if="defaultImage"
        size="156">
        <img
          :src="imagePreview ? imagePreview : defaultImage"
          alt="avatar"
          width="156"
        />
      </v-avatar>
      <div class="flex justify-space-between w-1/3 mt-4">
        <v-btn
          size="large"
          color="primary"
          @click="triggerFileUpload">
          Upload
        </v-btn>
        <v-btn
          size="large"
          color="error"
          @click="resetImage">
          Reset
        </v-btn>
      </div>
      <input
        type="file"
        ref="fileInput"
        class="hidden"
        accept="image/*"
        @change="handleImageUpload"
      />
      <p class="muted">Allowed JPG, GIF or PNG. Max size of 10MB</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps<{
  endpoint: string
  defaultImage: string
}>()

const imagePreview = ref<string | null>(null)
const fileInput = ref<HTMLInputElement | null>(null) // Declare the fileInput ref globally
const form = useForm({
  logo: null as File | null
})

const triggerFileUpload = () => {
  if (fileInput.value) {
    fileInput.value.click()  // Correctly trigger the file input dialog
  }
}

const handleImageUpload = (event: Event) => {
  const files = (event.target as HTMLInputElement).files
  if (files && files[0]) {
    const reader = new FileReader()
    reader.onload = (e: ProgressEvent<FileReader>) => {
      imagePreview.value = e.target?.result as string
    }
    reader.readAsDataURL(files[0])
    form.logo = files[0]

	uploadLogo()
  }
}

const resetImage = () => {
  imagePreview.value = null
  form.logo = null
}

const uploadLogo = async () => {
  if (form.logo) {
    console.log('Uploading logo...');
    form.post(props.endpoint, {
      onSuccess: () => {
        console.log('Logo uploaded successfully');
      },
      onError: (errors) => {
        console.log('Error uploading logo:', errors);
      }
    });
  } else {
    console.log('No logo selected');
  }
}

</script>
