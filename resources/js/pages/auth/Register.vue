<template>
  <div class="grid grid-cols-3 min-h-screen h-full">
    <div class="bg-primary">
      <div class="bg-register-img bg-no-repeat bg-cover bg-right-top opacity-10 min-h-screen">
        <div class="flex flex-col opacity-100">
          <div>Title</div>
          <div>Title</div>
        </div>
      </div>
    </div>
    <div class="col-span-2 flex flex-col py-10 px-5">
      <div class="flex-none flex flex-row justify-end">
        <logo></logo>
      </div>
      <div class="flex-grow p-10">
        <form @submit.prevent="register">
          <div class="grid grid-cols-2 gap-5">
            <div class="col-span-2">Sign Up</div>
            <div class="col-span-2"><hr></div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="firstname">
                First Name
              </label>
              <input v-model="data.firstname"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full invalid:border-red-700 invalid:bg-red-700/15 invalid:placeholder-red-500" id="firstname"
                type="text" name="firstname" placeholder="Enter first name" required="required" autofocus="autofocus">
              <div v-if="errors && errors.firstname">
                <p v-for="(error, index) in errors.firstname" :key="'firstname-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="lastname">
                Last Name
              </label>
              <input v-model="data.lastname"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="lastname"
                type="text" name="lastname" placeholder="Enter last name" required="required" autofocus="autofocus">
              <div v-if="errors && errors.lastname">
                <p v-for="(error, index) in errors.lastname" :key="'lastname-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div class="col-span-2">
              <label class="block font-medium text-sm text-gray-500" for="business_name">
                Business Name
              </label>
              <input v-model="data.business_name"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="business_name"
                type="text" name="business_name" placeholder="Enter business name" required="required" autofocus="autofocus">
              <div v-if="errors && errors.business_name">
                <p v-for="(error, index) in errors.business_name" :key="'business_name-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="email">
                Email
              </label>
              <input v-model="data.email"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
                type="email" name="email" placeholder="Enter email" required="required" autofocus="autofocus">
              <div v-if="errors && errors.email">
                <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="email">
                Phone Number
              </label>
              <input v-model="data.phone_number"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="phone_number"
                type="text" name="phone_number" placeholder="Enter mobile phone number" required="required" autofocus="autofocus">
              <div v-if="errors && errors.phone_number">
                <p v-for="(error, index) in errors.phone_number" :key="'phonenumber-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="password">
                Password
              </label>
              <input v-model="data.password"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 block mt-1 w-full"
                id="password" type="password" name="password" placeholder="Enter password" required="required" autocomplete="current-password">
              <div v-if="errors && errors.password">
                <p v-for="(error, index) in errors.password" :key="'password-' + index" class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="password">
                Repeat Password
              </label>
              <input v-model="data.password_confirmation"
                class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 block mt-1 w-full"
                id="password_confirmation" type="password" name="password_confirmation" placeholder="Enter password confirmation" required="required"
                autocomplete="current-password">
              <div v-if="errors && errors.password_confirmation">
                <p v-for="(error, index) in errors.password_confirmation" :key="'password_confirmation-' + index"
                  class="text-red-500 text-xs">{{ error }}</p>
              </div>
            </div>
            <div class="col-span-2">
              <button type="submit"
                class="w-full items-center bg-secondary px-4 py-2 bg-gray-900 border border-transparent rounded-lg font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Register
              </button>
            </div>
            <div class="col-span-2">
              <div class="text-center text-sm mt-4">
                Already have an account?
                <router-link class="underline text-gray-500 hover:text-gray-200" :to="{ name: 'Login' }">
                  Login
                </router-link>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
        <form @submit.prevent="register">
          <div>
            <label class="block font-medium text-sm text-gray-500" for="email">
              Business Name
            </label>
            <input v-model="data.name"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="name"
              type="text" name="name" required="required" autofocus="autofocus">
            <div v-if="errors && errors.name">
              <p v-for="(error, index) in errors.name" :key="'name-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="email">
              Business Email
            </label>
            <input v-model="data.email"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
              type="email" name="email" required="required" autofocus="autofocus">
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="email">
              Business Type
            </label>
            <SearchDropdown 
              v-model="data.business_type"
              :options="business_type_options"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" />
            <!-- <input v-model="data.email"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
              type="email" name="email" required="required" autofocus="autofocus"> -->
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="email">
              Business Features
            </label>
            <SearchDropdown 
              v-model="data.business_type"
              :options="business_features_options"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" />
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="email">
              Country
            </label>
            <multiselect 
              v-model="data.country" 
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" 
              :options="country_options"
              @search-change="handleSearchChange">
            </multiselect>
            <!-- <input v-model="data.country"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
              type="text" name="email" required="required" autofocus="autofocus"> -->
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="email">
              State or Province
            </label>
            <input v-model="data.state"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 block mt-1 w-full" id="email"
              type="text" name="email" required="required" autofocus="autofocus">
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="password">
              Password
            </label>
            <input v-model="data.password"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 block mt-1 w-full"
              id="password" type="password" name="password" required="required" autocomplete="current-password">
            <div v-if="errors && errors.password">
              <p v-for="(error, index) in errors.password" :key="'password-' + index" class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="mt-4">
            <label class="block font-medium text-sm text-gray-500" for="password">
              Repeat Password
            </label>
            <input v-model="data.password_confirmation"
              class="p-2 rounded-md shadow-sm bg-white border border-gray-300 text-gray-400 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 block mt-1 w-full"
              id="password_confirmation" type="password" name="password_confirmation" required="required"
              autocomplete="current-password">
            <div v-if="errors && errors.password_confirmation">
              <p v-for="(error, index) in errors.password_confirmation" :key="'password_confirmation-' + index"
                class="text-red-500">{{ error }}</p>
            </div>
          </div>
          <div class="flex items-center justify-end mt-4">
            <button type="submit"
              class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
              Register
            </button>
          </div>
        </form>
</template>

<script>
import { mapActions } from 'pinia'
import { useAuthStore } from '@/stores/auth.js'
import Logo from '@/components/Logo.vue'
import SearchDropdown from '@/components/SearchDropdown.vue'
import VueInputDropdown from 'vue-input-dropdown'
import Multiselect from 'vue-multiselect'
import { debounce } from 'lodash';

export default {
  data: () => {
    return {
      data: {
        firstname: null,
        lastname: null,
        business_name: null,
        email: null,
        password: null,
        password_confirmation: null,
        country: null,
        state: null,
      },
      business_type_options: [],
      business_features_options: [],
      country_options: [],
      errors: null,
      items: [
        'Item One',
        'Item Two',
        'Item Three',
        'Item Four',
        'Item Five',
        'Item Six',
        'Item Seven',
      ],
      options: {
        height: '5rem',
        width: '15rem',
        placeholder: 'Example Picker',
        outerContainerStyle: 'margin: 0 auto'
      },
      optionsTwo: {
        height: '3rem',
        width: '28rem',
        placeholder: 'Example Picker Two',
        outerContainerStyle: 'margin: 0 auto',
        activeItemClass: 'black-active',
        inputStyle: 'border: 1px solid black',
        maxHeight: '10rem'
      }
    }
  },
  components: {
    Logo,
    SearchDropdown,
    VueInputDropdown,
    Multiselect 
  },
  methods: {
    ...mapActions(useAuthStore, ['attempt_user']),
    register() {
      this.errors = null

      this.errors = {
        firstname: ['The firstname field is required.'],
        lastname: ['The lastname field is required.'],
        business_name: ['The business name field is required.'],
        email: ['The email field is required.'],
        phone_number: ['The phone number field is required.'],
        password: ['The password field is required.'],
        password_confirmation: ['The password confirmation field is required.'],
      }
      // axios.get('/sanctum/csrf-cookie').then(response => {
      //   axios.post('/register', this.data)
      //     .then((response) => {
      //       this.attempt_user()
      //         .then(() => {
      //           this.$router.push({ name: 'Home' })
      //         })
      //         .catch((error) => {
      //           console.error(error);
      //         })
      //     })
      //     .catch((error) => {
      //       this.errors = error.response.data.errors
      //     })
      // });
    },
    async getBusinessTypes() {
      let data = await axios.get('/api/v1/business/types')
        .then((response) => {
          return response.data
        })
        .catch((error) => {
          console.error(error);
          return [];
        })

        console.log('types', data);
        
      
      if (data.status == 'success') {
        this.business_type_options = data.data;
      }
    },
    async getBusinessFeatures() {
      let data = await axios.get('/api/v1/business/features')
        .then((response) => {
          return response.data
        })
        .catch((error) => {
          console.error(error);
          return [];
        })

        console.log('features', data);
        
      
      if (data.status == 'success') {
        this.business_features_options = data.data;
      }
    },
    picked(item) {
      console.log(item)
    },
    async findCountry(country) {
      // console.log('find country', country);
      
      axios.get('https://countriesnow.space/api/v0.1/countries/states', {
          country: country,
          withCredentials: false,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        })
    },
    handleSearchChange: debounce(function(searchTerm) {
      this.findCountry(searchTerm);
    }, 500) // 500ms debounce time
  },
  mounted() {
    this.getBusinessTypes()
    this.getBusinessFeatures()
  },
}
</script>
