<template>
    <div class="flex flex-col items-center gap-10">
        <div class="bg-primary text-white w-full min-h-48 rounded-b-2xl flex flex-col p-5 gap-5">
            <div class="flex flex-row text-2xl">
                <div class="grow font-bold">User Management</div>
                <div class="flex-none">
                    <InputDropdown @add="isModalVisible = true" />
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <h2>Search & Filters</h2>
                <div class="grid grid-cols-2 gap-3 text-black">
                    <div class="basis-1/2">
                        <Input label="Search" placeholder="Enter name" />
                    </div>
                    <div class="basis-1/2">
                        <Select :options="options" label="Select role" v-model="filterRole" />
                    </div>
                    <div class="basis-1/2">
                        <Select :options="options" label="Select status" v-model="filterStatus" />
                    </div>
                    <div class="basis-1/2">
                        <Select :options="options" label="Select address" v-model="filterAddress" />
                    </div>
                </div>
                <div>
                    <div class="flex flex-row gap-3 justify-end">
                        <button class="bg-gray-50 px-5 py-1 text-gray-500 text-sm rounded-lg font-semibold">Clear All</button>
                        <button class="bg-secondary px-5 py-1 text-white text-sm rounded-lg font-semibold">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-5 border border-gray-300 rounded-2xl">
            <table class="table-auto border-collapse w-full text-left">
                <thead>
                    <tr>
                        <th class="p-5">Name, ID</th>
                        <th class="p-5">Role</th>
                        <th class="p-5">Contact Details</th>
                        <th class="p-5">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, key) in userList" :key="key" class="hover:bg-gray-200">
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">{{ user.full_name }}, 123</td>
                        <td class="p-5">{{ user?.roles[0]?.name }}</td>
                        <td class="p-5">{{ user.email }}</td>
                        <td class="p-5"><span class="success-pill">Active</span></td>
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">
                            <DropdownActions 
                                :actions="['View', 'Edit', 'Delete']" 
                                @actionSelected="(action) => handleAction(action, user.id)"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-row gap-3 justify-between w-full text-accent">
            <div class="flex flex-row gap-3">
                <div class="flex flex-row gap-5 items-center">
                    1-20 of 100
                </div>
                <div class="flex flex-row gap-5 items-center">
                    <ChevronLeftIcon class="size-5" />
                    <ChevronRightIcon class="size-5" />
                </div>
            </div>
            <div class="flex flex-row gap-3 items-center">
                <span>View:</span>
                <Select :options="perPage" v-model="selectedLimit" />
            </div>
        </div>
        <div class="flex-1 border-black border-s w-px">
            <!-- Modal Component -->
            <AddUserFormModal :show="isModalVisible" @close="isModalVisible = false" />
        </div>
    </div>
</template>

<style scoped>
    .success-pill {
        @apply bg-[#3CE81A1F] text-[#3CE81A] font-bold rounded-2xl px-3 py-1;
    }
    
    .danger-pill {
        @apply bg-[#E81A1A1F] text-[#E81A1A] font-bold rounded-2xl px-3 py-1;
    }
</style>
<script setup>
import { ref, computed } from "vue";
import InputDropdown from '@/components/InputDropdown.vue'
import AddUserFormModal from '@/components/AddUserForm.vue'
import Input from '@/components/Input.vue'
import Select from '@/components/Select.vue'
import axios from 'axios'
import { ChevronRightIcon, ChevronLeftIcon, EllipsisVerticalIcon } from '@heroicons/vue/24/solid'
import DropdownActions from '@/components/DropdownActions.vue'

// Modal visibility state
const isModalVisible = ref(false);
const filterRole = ref(0);
const filterStatus = ref(0);
const filterAddress = ref(0);
const userList = ref([]);
const options = [
    { id: 1, name: 'Admin' },
    { id: 2, name: 'User' },
    { id: 3, name: 'Guest' },
];
const perPage = [
    { id: 10, name: '10' },
    { id: 25, name: '25' },
    { id: 50, name: '50' },
    { id: 100, name: '100' },
    { id: 200, name: '200' },
];
const pagination = ref(null);
const selectedLimit = ref(10);

const handleAction = (action, index) => {
    console.log(`Row ${index + 1}: ${action} clicked`);
};

// Methods
const getUsers = async () => {
    const req = await axios.get('api/v1/business/users', {
        params: {
            'iso2': ''
        }
    })

    const results = req.data.data;
    console.log('Get users', results);

    userList.value = results.data;
    pagination.value = results;
}

// Execute Methods
getUsers();
</script>