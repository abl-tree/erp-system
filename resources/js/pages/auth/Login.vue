<template>
  <div class="w-full min-h-lvh grid grid-cols-2">
    <!-- Half Layout (Two Equal Columns) -->
    <div class="bg-primary relative">
      <div class="absolute inset-0 bg-login-img bg-no-repeat bg-cover bg-center opacity-10 min-h-screen"></div>
      <div class="relative text-white h-full w-full flex flex-col justify-center items-center">
        <div class="text-2xl">Header Something</div>
        <div class="px-28 py-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero vulputate at. Donec et orci vel turpis luctus malesuada ac ut nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis elit dui, id mollis mauris tincidunt consequat. Nam fringilla suscipit varius.</div>
      </div>
    </div>
    <div></div>

    <!-- Boxed Container in the Center -->
    <div class="absolute left-1/2 top-0 transform -translate-x-1/2 container min-h-screen h-full">
      <div class="grid grid-cols-2 h-full">
        <div >

        </div>
        <div class="flex flex-col p-5">
          <div class="flex-none flex flex-row justify-end">
            <logo></logo>
          </div>
          <div class="flex-grow flex flex-col justify-center items-center p-5">
            <div>
              <h1 class="text-[40px] font-bold text-gray-800">Login</h1>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
              <form @submit.prevent="login">
                <div>
                  <!-- <label class="block font-medium text-sm text-gray-500" for="email">
                    Email
                  </label> -->
                  <input v-model="data.email"
                    class="p-2 rounded-xl shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
                    type="email" name="email" placeholder="Username / Email" required="required" autofocus="autofocus">
                </div>
                <div class="mt-4">
                  <!-- <label class="block font-medium text-sm text-gray-500" for="password">
                    Password
                  </label> -->
                  <input v-model="data.password"
                    class="p-2 rounded-xl shadow-sm bg-white border border-gray-300 text-gray-400 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 block mt-1 w-full"
                    id="password" type="password" name="password" placeholder="Password" required="required" autocomplete="current-password">
                </div>
                <div v-if="errors" class="text-red-500 py-2 font-semibold">
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
                    <router-link class="underline text-sm text-gray-500 hover:text-gray-200" :to="{ name: 'ForgotPassword' }">
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
              <router-link class="underline text-gray-500 hover:text-gray-200" :to="{ name: 'Register' }">
                Sign up
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Logo from '@/components/Logo.vue'
import { useAuthStore } from '@/stores/auth.js'
import { mapActions } from 'pinia'

export default {
  data: () => {
    return {
      errors: null,
      data: {
        email: null,
        password: null,
        remember: null,
      },
    }
  },
  components: {
    Logo,
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
            this.errors = error
          })
      });
    },
  },
}
</script>
