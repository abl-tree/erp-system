<template>
    <div class="flex flex-col items-center gap-10">
        <div class="bg-primary text-white w-full min-h-48 rounded-b-2xl flex flex-col p-5 gap-5">
            <div class="flex flex-row text-2xl">
                <div class="grow font-bold">User Management</div>
                <div v-if="canModify" class="flex-none">
                    <InputDropdown @add="handleAddUserOpen" />
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <h2>Search & Filters</h2>
                <div class="grid grid-cols-2 gap-3 text-black">
                    <div class="basis-1/2">
                        <Input label="Search" placeholder="Enter name" v-model="filterName" />
                    </div>
                    <div class="basis-1/2">
                        <Select :options="rolesOptions" label="Select role" v-model="filterRole" />
                    </div>
                    <div class="basis-1/2">
                        <Select :options="statusOptions" label="Select status" v-model="filterStatus" />
                    </div>
                    <div class="basis-1/2">
                        <Input placeholder="Enter email" label="Search" v-model="filterAddress" />
                    </div>
                </div>
                <div>
                    <div class="flex flex-row gap-3 justify-end">
                        <button class="bg-gray-50 px-5 py-1 text-gray-500 text-sm rounded-lg font-semibold">Clear All</button>
                        <button class="bg-secondary px-5 py-1 text-white text-sm rounded-lg font-semibold" @click="handleFilter">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border border-gray-300 rounded-2xl">
            <table class="table-auto border-collapse w-full text-left">
                <thead>
                    <tr>
                        <th class="p-5 first:rounded-tl-xl last:rounded-tr-xl hover:bg-secondary hover:text-white cursor-pointer">Name, ID</th>
                        <th class="p-5 first:rounded-tl-xl last:rounded-tr-xl hover:bg-secondary hover:text-white cursor-pointer">Role</th>
                        <th class="p-5 first:rounded-tl-xl last:rounded-tr-xl hover:bg-secondary hover:text-white cursor-pointer">Contact Details</th>
                        <th class="p-5 first:rounded-tl-xl last:rounded-tr-xl hover:bg-secondary hover:text-white cursor-pointer" colspan="2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="userList.length" v-for="(user, key) in userList" :key="key" class="hover:bg-gray-200">
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">{{ user.full_name }}, {{ user.id_number }}</td>
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">{{ user?.roles[0]?.name }}{{ user?.roles[0]?.sub_role?.name ? ' - ' + user?.roles[0]?.sub_role?.name : ''  }}</td>
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">{{ user.email }}</td>
                        <td class="p-5 first:rounded-l-xl last:rounded-r-xl">
                            <span v-if="user?.status?.name == 'Active'" class="success-pill"> {{ user?.status?.name }} </span>
                            <span v-else-if="user?.status?.name == 'Disabled'" class="danger-pill"> {{ user?.status?.name }} </span>
                        </td>
                        <td v-if="canModify" class="p-5 first:rounded-l-xl last:rounded-r-xl">
                            <DropdownActions 
                                v-if="user?.status?.name == 'Active'" 
                                :actions="{'view': 'View', 'edit': 'Edit', 'delete': 'Delete', 'disabled': 'Disable'}" 
                                @actionSelected="(action, index) => handleAction(action, user, index)"
                            />
                            <DropdownActions 
                                v-else
                                :actions="{'view': 'View', 'edit': 'Edit', 'delete': 'Delete', 'enable': 'Enable'}" 
                                @actionSelected="(action, index) => handleAction(action, user, index)"
                            />
                        </td>
                    </tr>
                    <tr v-else>
                        <td class="p-5 text-center" colspan="4">No records found</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-row gap-3 justify-between w-full text-accent px-5">
            <div class="flex flex-row gap-3">
                <div class="flex flex-row gap-5 items-center">
                    {{ pagination?.from || 0 }}-{{ pagination?.to || 0 }} of {{ pagination?.total || 0 }}
                </div>
                <div class="flex flex-row gap-5 items-center">
                    <button type="button" :class="{ 'cursor-not-allowed': !pagination?.prev_page_url }" @click="handlePage('prev')" :disabled="!pagination?.prev_page_url">
                        <ChevronLeftIcon class="size-5" />
                    </button>
                    <button type="button" :class="{ 'cursor-not-allowed': !pagination?.next_page_url }" @click="handlePage('next')" :disabled="!pagination?.next_page_url">
                        <ChevronRightIcon class="size-5" />
                    </button>
                </div>
            </div>
            <div class="flex flex-row gap-3 items-center">
                <span>View:</span>
                <Select :options="perPage" v-model="selectedLimit" @change="handlePerPage" />
            </div>
        </div>
        <div class="flex-1 border-black border-s w-px">
            <!-- Modal Component -->
            <AddUserFormModal :show="isModalVisible" @close="handleAddUserClose" />
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
import { ref, computed, nextTick, watch } from "vue";
import InputDropdown from '@/components/InputDropdown.vue'
import AddUserFormModal from '@/components/AddUserForm.vue'
import Input from '@/components/Input.vue'
import Select from '@/components/Select.vue'
import axios from 'axios'
import { ChevronRightIcon, ChevronLeftIcon, EllipsisVerticalIcon } from '@heroicons/vue/24/solid'
import DropdownActions from '@/components/DropdownActions.vue'
import { useAuthStore } from "@/stores/auth";
import { useAccountStore } from "@/stores/account";
import { useUserManagementStore } from "@/stores/user-management";
import { useBusinessStore } from "@/stores/business";
import paginationConf from "@/config/pagination";

const authStore = useAuthStore();
const accountStore = useAccountStore();
const userManagementStore = useUserManagementStore();
const businessStore = useBusinessStore();

// Modal visibility state
const isModalVisible = ref(false);
const filterName = ref('');
const filterRole = ref(0);
const filterStatus = ref(0);
const filterAddress = ref('');
const userList = ref(userManagementStore.users);
const rolesOptions = ref(accountStore.roles);
const statusOptions = ref(accountStore.status);
const perPage = paginationConf.PAGE_SIZES;
const pagination = ref(null);
const selectedLimit = ref(paginationConf.ITEMS_PER_PAGE);
const selectedPage = ref(paginationConf.DEFAULT_PAGE);

const getStatusOptions = () => {
    if (accountStore.statusList.length == 0) {
        accountStore.getStatus()
    }
};

getStatusOptions();

const getRolesOptions = () => {
    if (accountStore.roles.length == 0) {
        accountStore.getRoles()
    }
};

getRolesOptions();

const handleAction = (action, user, index) => {
    if (action == 'disabled') {
        user.index = index;
        businessStore.disableUser(user);
    } else if (action == 'enable') {
        user.index = index;
        businessStore.enableUser(user);
    } else {
        userManagementStore.setUser(user, action);

        isModalVisible.value = true;
    }
};

const handleFilter = () => {
    selectedPage.value = 1;

    getUsers();
};

const handleAddUserClose = () => {
    isModalVisible.value = false

    userManagementStore.setUser({
        firstname: null,
        lastname: null,
        email: null,
        phone: null,
        street: null,
        postal_code: null,
        country: null,
        city: null,
        business_type: null,
        role: null,
        job_position: null,
        department: null,
        employment_type: null,
        special_notes: null,
        start_date: '',
        attendance_shift: null
    }, null);
}

const handleAddUserOpen = () => {
    isModalVisible.value = true

    userManagementStore.setUser({
        firstname: null,
        lastname: null,
        email: null,
        phone: null,
        street: null,
        postal_code: null,
        country: null,
        city: null,
        business_type: null,
        role: null,
        job_position: null,
        department: null,
        employment_type: null,
        special_notes: null,
        start_date: '',
        attendance_shift: null
    }, null);
};

const handlePerPage = async () => {
    selectedPage.value = 1;

    await nextTick();

    getUsers();
};

const handlePage = (direction) => {
    if (direction === 'next') {
        selectedPage.value++;
    } else {
        selectedPage.value--;
    }

    if (selectedPage.value < 1) {
        selectedPage.value = 1;
    }

    getUsers();
};

// Methods
const getUsers = async () => {
    userManagementStore.getUsers(
        selectedPage.value,
        selectedLimit.value,
        {
            name: filterName.value,
            role: filterRole.value,
            status: filterStatus.value,
            address: filterAddress.value,
        }
    ).then(() => {
        userList.value = userManagementStore.users;
        pagination.value = userManagementStore.pagination;
    });
}

// Execute Methods
getUsers();

const canModify = computed(() => {
    return authStore.user.roles[0].sub_role.id == 1;
});

watch(() => accountStore.roles, (newRoles) => {
  rolesOptions.value = newRoles.length ? newRoles : []; // Prevent empty state
}, { immediate: true });

watch(() => accountStore.status, (newStatus) => {
  statusOptions.value = newStatus.length ? newStatus : []; // Prevent empty state
}, { immediate: true });

watch(() => userManagementStore.users, (newUSers) => {    
  userList.value = newUSers.length ? newUSers : []; // Prevent empty state
}, { immediate: true });
</script>