<template>
  <div class="grid grid-cols-2 min-h-screen h-full">
    <div class="relative bg-primary">
      <div class="absolute inset-0 bg-register-img bg-no-repeat bg-cover bg-right-top opacity-10 min-h-screen"></div>
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
          <h1 class="text-[40px] font-bold text-gray-800">Forgot Password?</h1>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
          <form @submit.prevent="resetPassword">
            <div>
              <label class="block font-medium text-sm text-gray-500" for="email">
                Registered Email
              </label>
              <input v-model="email"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
                type="email" name="email" required="required" autofocus="autofocus">
            </div>
            <div v-if="errors" class="text-red-500 py-2 font-semibold">
              <span>{{ errors.message }}</span>
            </div>
            <div class="flex items-center justify-end mt-4">
              <button type="submit"
                class="w-full text-base px-4 py-2 text-center bg-secondary rounded-xl font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Send Email
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
  <!-- <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 p-4">
    <logo></logo>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
      <form @submit.prevent="resetPassword">
        <div>
          <label class="block font-medium text-sm text-gray-500" for="email">
            Email
          </label>
          <input v-model="email"
            class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
            type="email" name="email" required="required" autofocus="autofocus">
        </div>
        <div v-if="errors" class="text-red-500 py-2 font-semibold">
          <span>{{ errors.message }}</span>
        </div>
        <div class="flex items-center justify-end mt-4">
          <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
            Send Password-Reset E-Mail
          </button>
        </div>
      </form>
    </div>
  </div> -->
</template>

<script>
import Logo from '@/components/Logo.vue'

export default {
  data: () => {
    return {
      email: null,
      errors: null,
    }
  },
  components: {
    Logo,
  },
  methods: {
    resetPassword() {
      this.errors = null
      axios.post('/forgot-password', { email: this.email })
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
