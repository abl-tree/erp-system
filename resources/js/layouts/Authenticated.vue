<template>
  <main class="flex min-h-screen h-full">
    <!-- <navigation></navigation> -->
    <Sidebar /> 
    <div class="flex-1">
      <router-view></router-view>
    </div>
  </main>
</template>

<script setup>
import Navigation from '@/components/Navigation.vue'
import Sidebar from '@/components/Sidebar.vue'
</script>
