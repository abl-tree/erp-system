<template>
  <div class="grid grid-cols-2 min-h-screen h-full">
    <!-- Half Layout (Two Equal Columns) -->
    <div class="bg-primary relative">
      <div class="absolute inset-0 bg-login-img bg-no-repeat bg-cover bg-center opacity-10 min-h-screen"></div>
      <div class="relative text-white h-full w-full flex flex-col justify-center items-center">
        <div class="text-2xl">Header Something</div>
        <div class="px-28 py-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero vulputate at. Donec et orci vel turpis luctus malesuada ac ut nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis elit dui, id mollis mauris tincidunt consequat. Nam fringilla suscipit varius.</div>
      </div>
    </div>
    <div class="flex flex-col py-10 px-5">
      <div class="flex-none flex flex-row justify-end">
        <logo></logo>
      </div>
      <div class="flex-grow flex flex-col justify-center items-center p-5">
            <div>
              <h1 class="text-[40px] font-bold text-gray-800">Login</h1>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
              <form @submit.prevent="login">
                <div class="relative">
                  <Input v-model="data.email"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.email }"
                    id="email"
                    type="email" name="email" placeholder="Username / Email" />
                  <div class="flex flex-row gap-1 absolute top-0 right-0 mt-3 mr-3">
                    <ExclamationTriangleIcon v-if="errors && errors.email" class="size-5 text-red-700" />
                  </div>
                  <div v-if="errors && errors.email">
                    <span v-for="error in errors.email" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </div>
                <div class="mt-4 relative">
                  <Input v-model="data.password"
                    class="p-2 block mt-1 w-full"
                    :class="{ 'custom-invalid': errors && errors.password }"
                    id="password" type="password" name="password" placeholder="Password" />
                  <div v-if="errors && errors.password">
                    <span v-for="error in errors.password" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                  <div class="flex flex-row gap-1 absolute top-0 right-0 mt-3 mr-3">
                    <ExclamationTriangleIcon v-if="errors && errors.password" class="size-5 text-red-700" />
                    <EyeIcon v-if="show_password" @click="togglePassword(false)" class="size-5 cursor-pointer" />
                    <EyeSlashIcon v-else @click="togglePassword(true)" class="size-5 cursor-pointer" />
                  </div>
                </div>
                <div v-if="errors && errors.message" class="text-red-500 py-2 font-semibold">
                  <span>{{ errors.message }}</span>
                </div>
                <div class="block mt-4">
                  <div class="flex flex-rows justify-between items">
                    <label for="remember" class="inline-flex items-center">
                      <input v-model="data.remember" id="remember" type="checkbox"
                        class="rounded border border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                      <span class="ml-2 text-sm text-gray-500">Keep me logged in</span>
                    </label>
                    <router-link class="underline text-sm text-blue-700 hover:text-blue-500" :to="{ name: 'ForgotPassword' }">
                      Forgot your password?
                    </router-link>
                  </div>
                </div>
                <div class="flex items-center mt-4">
                  <button type="submit"
                    class="w-full text-base px-4 py-2 text-center bg-secondary rounded-xl font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Log in
                  </button>
                </div>
              </form>
            </div>
            <div class="text-center text-sm mt-4">
              Don't have an account yet?
              <router-link class="underline text-blue-700 hover:text-blue-500 font-bold" :to="{ name: 'Register' }">
                Sign up
              </router-link>
            </div>
          </div>
    </div>
  </div>

  <!-- Modal -->
  <div
    v-if="isModalOpen"
    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center"
    @click="closeModal"
  >
    <!-- Modal content -->
    <div class="bg-white px-16 py-8 rounded-xl shadow-lg w-full max-w-3xl" @click.stop>
      <div v-if="currentSlide == 1" class="relative flex justify-center space-x-2">
        <div class="grow-0 absolute top-1/2 -right-10 -translate-y-1/2">
          <ArrowRightStartOnRectangleIcon class="size-8 h-fit text-secondary cursor-pointer" @click="redirectToHome()" />
        </div>
      </div>

      <div v-if="currentSlide == 0" class="flex flex-col justify-center items-center px-36 py-14 gap-4">
        <SolidFireworks class="flex-none" />
        <h2 class="text-2xl font-semibold text-center">Your account is now registered!</h2>
        <p class="text-gray-600 text-xs text-center">A verification email has been sent to your registered email address. Click the verification link in your email to activate your account.</p>
      </div>
      <div v-else class="flex flex-col justify-center items-center px-36 py-14 gap-4">
        <SolidMail class="flex-none" />
        <h2 class="text-2xl font-semibold text-center">Verification</h2>
        <p class="text-gray-600 text-xs text-center">Check your email for the verification link sent to <span class="font-bold">{{ currentUser?.email }}</span></p>
        <p class="text-gray-600 text-xs text-center">Not in inbox or spam folder? <span class="font-bold font-link">Resend</span></p>
      </div>

      <div class="relative flex justify-center space-x-2">
        <div class="grow flex flex-row gap-2 justify-center items-center">
          <span
            v-for="(slide, index) in slides"
            :key="index"
            :class="[
              'w-3 h-3 bg-gray-300 rounded-full cursor-pointer',
              { '!bg-gray-600': currentSlide === index }
            ]"
            @click="goToSlide(index)"
          ></span>
        </div>
        <div v-if="currentSlide == 0" class="grow-0 absolute top-1/2 right-0 -translate-y-1/2">
          <ArrowLongRightIcon class="size-10 h-fit text-gray-700 cursor-pointer" @click="currentSlide = 1" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Logo from '@/components/Logo.vue'
import { useAuthStore } from '@/stores/auth.js'
import { mapActions } from 'pinia'
import { EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/outline'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/solid'
import Input from '@/components/Input.vue'

export default {
  data: () => {
    return {
      errors: null,
      data: {
        email: null,
        password: null,
        remember: null,
      },
      show_password: false
    }
  },
  components: {
    Logo,
    ExclamationTriangleIcon,
    EyeSlashIcon,
    EyeIcon,
    Input
  },
  methods: {
    ...mapActions(useAuthStore, ['attempt_user', 'set_user']),
    login() {
      this.errors = null

      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', this.data)
          .then((response) => {
            if (response?.status === 200 && response.data?.two_factor) {
              this.$router.replace({ name: 'TwoFactorChallenge' })
              return
            }

            this.attempt_user()
              .then((response) => {
                if (response?.status === 200) {
                  this.$router.replace({ name: 'Home' })
                }
              })
              .catch((error) => {
                this.errors = error
              })
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          })
      });
    },
    togglePassword(toggle = false) {
      this.show_password = toggle

      if (toggle) {
        document.getElementById('password').type = 'text'
      } else {
        document.getElementById('password').type = 'password'
      }
    }
  },
}
</script>
