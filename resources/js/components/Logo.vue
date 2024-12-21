<template>
    <div class="flex">
      <router-link :to="{ name: 'Login' }" class="flex flex-row items-center">
        <Logo />
        <LogoText />
      </router-link>
    </div>
</template>

<script setup>
import Logo from '@/assets/logo.svg'
import LogoText from '@/assets/logo-txt.svg'
</script>