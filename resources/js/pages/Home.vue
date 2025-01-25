<template>
  <div class="max-w-xl bg-white shadow-md rounded-lg mx-auto p-4 my-10">
    <h3 class="text-lg font-semibold">Welcome to dashboard.</h3>
  </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth.js'

const auth = useAuthStore()

console.log(auth.currentUser);

</script>