<script setup lang="ts">
import { ref } from 'vue';
import { useTaskStore } from '@/stores/apps/kanban/task';
import { formatDistanceToNowStrict } from 'date-fns';

const props = defineProps({
    task: null,
   
});

// common components
const dialog = ref(false);
const store = useTaskStore();


function save() {
    return dialog.value=false
}
function cancel() {
    return dialog.value=false
}
</script>

<template>
    <!-- ---------------------------------------------------- -->
    <!-- Table Basic -->
    <!-- ---------------------------------------------------- -->
    <v-card elevation="10" class="mb-5">
        <div class="d-flex align-center justify-space-between px-4 py-2 pr-3">
            <h5 class="text-subtitle-2 font-weight-semibold pr-4 cursor-move">{{ task?.title }}</h5>
            <RouterLink to="" class="px-0">
                <DotsVerticalIcon size="15" />

                <v-menu activator="parent">
                    <v-list density="compact">
                        <v-list-item value="Edit">
                            <v-list-item-title @click="dialog = true">Edit</v-list-item-title>
                        </v-list-item>
                        <v-list-item value="Delete">
                            <v-list-item-title @click="store.deleteTask(task?.id)">Delete</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </RouterLink>
            <v-dialog v-model="dialog" max-width="500">
                <v-card>
                    <v-card-text class="mb-4" >
                        <h4 class="text-h6 mb-5">Edit Task </h4>
                        <v-text-field outlined name="Task" v-model="task.title" label="Title"></v-text-field>
                        <v-textarea outlined name="Task-subtitle" v-model="task.subtitle" label="Subtitle"></v-textarea>
                        <v-select label="Select" v-model="task.category" variant="outlined"
                            :items="['Mobile', 'Design', 'Development']"></v-select>
                        <v-select label="Select" v-model="task.categorybg" variant="outlined"
                            :items="['primary', 'warning', 'success', 'error']"></v-select>
                        <v-btn color="primary" variant="flat" @click="save" >Save</v-btn>
                        <v-btn  variant="flat" @click="cancel">Cancel</v-btn>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </div>
        <!-- IF IMAGE -->
        <v-img v-if="task?.taskimg" :src="task?.taskimg" height="110px" cover class="w-100 "></v-img>
        <!-- IF SUBTEXT -->
        <p v-if="task?.subtitle" class="text-subtitle-2 px-4 textSecondary">{{ task?.subtitle }}</p>
        

        <div class="d-flex align-center justify-space-between px-4 py-3">
            <div class="d-flex align-center">
                <CalendarIcon size="16" class="textSecondary" />
                <div class="text-body-2 pl-2 textSecondary">{{
                                formatDistanceToNowStrict(new Date((task?.date)), {
                                    addSuffix: false
                                }) 
                            }} ago</div>
            </div>
            <div :class="'rounded-sm text-10 px-2 py-0 bg-' + task?.categorybg" size="small">
                {{ task?.category }}
            </div>
        </div>
    </v-card>
</template>
