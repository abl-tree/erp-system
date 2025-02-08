<template>
<!-- Sidebar -->
<div class="bg-neutral-100 text-white w-64 p-4 flex flex-col">
    <!-- Logo -->
    <div class="text-2xl font-bold mb-8">
        My Sidebar
    </div>
    <!-- Menu Items -->
    <nav class="flex-1 space-y-4 text-primary font-bold">
        <router-link :to="{ name: 'Home' }" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl">
            <span class="mr-3">
                <Squares2X2Icon class="size-5" />
            </span> Dashboard
        </router-link>
        <router-link :to="{ name: 'Home' }" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl">
            <span class="mr-3">
                <CalendarDaysIcon class="size-5" />
            </span> Schedule
        </router-link>
        <router-link :to="{ name: 'Home' }" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl">
            <span class="mr-3">
                <CreditCardIcon class="size-5" />
            </span> Payments
        </router-link>
        <router-link :to="{ name: 'UserManagement' }" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl">
            <span class="mr-3">
                <UsersIcon class="size-5" />
            </span> User Management
        </router-link>
        <router-link :to="{ name: 'Profile' }" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl">
            <span class="mr-3">
                <UserIcon class="size-5" />
            </span> Profile
        </router-link>
        <a @click="logoutUser()" class="flex items-center px-4 py-4 text-sm hover:bg-secondary hover:text-white rounded-xl cursor-pointer">
            <span class="mr-3">
                <ArrowRightStartOnRectangleIcon class="size-5" />
            </span> Logout
        </a>
    </nav>
    <!-- Footer -->
    <div class="text-sm text-gray-400 mt-8">
        © 2024 My Sidebar
    </div>
</div>
</template>

<script setup>
import { Squares2X2Icon, CalendarDaysIcon, CreditCardIcon, UsersIcon, UserIcon } from '@heroicons/vue/24/solid'
import { ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/outline'
import { useAuthStore } from '@/stores/auth.js'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const logoutUser = () => {
    authStore.logout()
    .then(() => {
        router.push({ name: 'Login' })
    })
}
</script>