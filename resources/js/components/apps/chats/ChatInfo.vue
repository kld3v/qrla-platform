<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useChatStore } from '@/stores/apps/chat';
import { uniq, flatten } from 'lodash';
import { DownloadIcon } from 'vue-tabler-icons';
const props = defineProps({ chatDetail: Object });

const totalAttachment = computed(() => {
    return uniq(flatten(props.chatDetail?.chatHistory.map((item: any) => item.attachment))).length;
});

const totalMedia = computed(() => {
    return uniq(flatten(props.chatDetail?.chatHistory.map((item: any) => (item?.type === 'img' ? item.msg : null)))).length - 1;
});
</script>
<template>
    <div v-if="chatDetail" class="pa-6">
        <h6 class="text-h6 mb-3">
            Media <span class="text-muted">({{ totalMedia }})</span>
        </h6>
        <div v-for="chat in chatDetail.chatHistory" :key="chat.id">
            <div v-if="chat.type == 'img'">
                <img :src="chat.msg" alt="img" class="rounded-md" width="100" />
            </div>
        </div>

        <h6 class="text-h6 mb-3 mt-7">
            Attachments <span class="text-muted">({{ totalAttachment }})</span>
        </h6>
        <v-sheet v-if="totalAttachment != 0">
            <RouterLink to="" v-for="chat in chatDetail.chatHistory" class="text-decoration-none  " :key="chat.id">
                <div class="d-flex gap-3 align-center mt-5 attachment" v-for="atch in chat.attachment" :key="atch.file">
                    <v-avatar class="rounded-md bg-grey100" size="48">
                        <img width="24" alt="file" :src="atch.icon" />
                    </v-avatar>
                    <div>
                        <h6 class="text-subtitle-1 font-weight-semibold textPrimary mb-2 hover-link-primary">{{ atch.file }}</h6>
                        <p class="text-subtitle-2 mt-1 textSecondary">{{ atch.fileSize }}</p>
                    </div>
                    <DownloadIcon class="ms-auto download textPrimary hover-link-primary" size="20"></DownloadIcon>
                </div>
            </RouterLink>
        </v-sheet>
        <v-sheet v-else>
            <v-alert color="error" type="warning" density="compact" variant="tonal" class="text-subtitle-1">
                No Attachments Found!
            </v-alert>
        </v-sheet>
    </div>
</template>
