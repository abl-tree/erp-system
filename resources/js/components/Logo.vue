<template>
    <div class="flex">
      <router-link :to="{ name: 'Login' }" class="flex flex-row">
        <img :src="logo" alt="Logo" />
        <img :src="logoText" alt="Logo Text" />
      </router-link>
    </div>
</template>

<script>
import logo from '@/assets/logo.svg'
import logoText from '@/assets/logo-txt.svg'

export default {
  name: 'Logo',
  data() {
    return {
      logo: logo,
      logoText: logoText,
    }
  }
}
</script>