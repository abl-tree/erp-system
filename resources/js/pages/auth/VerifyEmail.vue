<template>
  <div class="min-h-screen h-full bg-primary flex flex-col justify-center items-center pt-6 sm:pt-0 p-4">
    <div class="bg-white px-16 py-8 rounded-xl shadow-lg w-full max-w-3xl">
      <div class="relative flex justify-center space-x-2">
        <div class="grow-0 absolute top-1/2 -right-10 -translate-y-1/2">
          <ArrowRightStartOnRectangleIcon class="size-8 h-fit text-secondary cursor-pointer" @click="logoutUser()" />
        </div>
      </div>

      <div class="flex flex-col justify-center items-center px-36 py-14 gap-4">
        <SolidMail class="flex-none" />
        <h2 class="text-2xl font-semibold text-center">Verification</h2>
        <p class="text-gray-600 text-xs text-center">Check your email for the verification link sent to <span class="font-bold">{{ currentUser.email }}</span></p>

        <form @submit.prevent="resendVerification">
          <div class="flex items-center justify-end mt-4">
            <p class="text-gray-600 text-xs text-center">Not in inbox or spam folder? <button type="submit"
              class="font-bold font-link">
              Resend
            </button></p>
          </div>
          
          <div v-if="errors" class="text-red-500 py-2 font-semibold">
            <span>{{ errors.message }}</span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import SolidMail from '@/assets/solid-mail.svg'
import { useAuthStore } from '@/stores/auth.js'
import { ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/outline'

const router = useRouter()
const authStore = useAuthStore()
const { currentUser } = authStore

const logoutUser = () => {
  authStore.logout()
  .then(() => {
    router.push({ name: 'Login' })
  })
}
</script>

<script>
export default {
  data() {
    return {
      errors: null,
    }
  },
  methods: {
    resendVerification() {
      this.errors = null
      axios.post('/email/verification-notification')
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          this.errors = error.response.data
        })
    }
  }
}
</script>
