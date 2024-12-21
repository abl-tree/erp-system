<template>
    <div class="flex flex-col items-center gap-3">
        <div class="bg-primary text-2xl text-white w-full min-h-48 rounded-b-2xl flex flex-row p-5">
            <div class="grow font-bold">User Management</div>
            <div class="flex-none">
                <InputDropdown />
            </div>
        </div>
        <div class="flex-1 border-black border-s w-px">
            <!-- Button to Open Modal -->
            <button @click="isModalVisible = true" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
            Open Modal
            </button>

            <!-- Modal Component -->
            <Modal :show="isModalVisible" @close="isModalVisible = false" />
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import InputDropdown from '@/components/InputDropdown.vue'
import Modal from '@/components/AddUserForm.vue'

// Modal visibility state
const isModalVisible = ref(false);
</script>