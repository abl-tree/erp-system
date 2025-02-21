<template>
  <div class="grid grid-cols-3 min-h-screen h-full">
    <div class="relative bg-primary">
      <div class="absolute inset-0 bg-register-img bg-no-repeat bg-cover bg-right-top opacity-10 min-h-screen"></div>
      <div class="relative text-white h-full w-full flex flex-col justify-center items-center">
        <div class="text-2xl">Header Something</div>
        <div class="px-28 py-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero vulputate at. Donec et orci vel turpis luctus malesuada ac ut nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis elit dui, id mollis mauris tincidunt consequat. Nam fringilla suscipit varius.</div>
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
                First Name <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.firstname">
                <template #input :errors="errors.firstname">
                  <Input v-model="data.firstname"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.firstname }"
                    id="firstname"
                    type="text" name="firstname" placeholder="Enter first name" autofocus="autofocus" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.firstname">
                    <span v-for="(error, index) in errors.firstname" :key="'firstname-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="lastname">
                Last Name <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.firstname">
                <template #input :errors="errors.lastname">
                  <Input v-model="data.lastname"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.lastname }"
                    id="lastname"
                    type="text" name="lastname" placeholder="Enter last name" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.lastname">
                    <span v-for="(error, index) in errors.lastname" :key="'lastname-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="col-span-2">
              <label class="block font-medium text-sm text-gray-500" for="business_name">
                Business Name <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.business_name">
                <template #input :errors="errors.business_name">
                  <Input v-model="data.business_name"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.business_name }"
                    id="business_name"
                    type="text" name="business_name" placeholder="Enter business name" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.business_name">
                    <span v-for="(error, index) in errors.business_name" :key="'business_name-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="email">
                Email <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.email">
                <template #input :errors="errors.email">
                  <Input v-model="data.email"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.email }"
                    id="email"
                    type="email" name="email" placeholder="Enter email address" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.email">
                    <span v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="email">
                Phone Number
              </label>
              <InputValidation :has_error="errors && errors.phone_number">
                <template #input :errors="errors.phone_number">
                  <Input v-model="data.phone_number"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.phone_number }"
                    id="phone_number"
                    type="text" name="phone_number" placeholder="Enter mobile phone number" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.phone_number">
                    <span v-for="(error, index) in errors.phone_number" :key="'phone_number-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="password">
                Password <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.password" :show_eye_icon="true">
                <template #input :errors="errors.password">
                  <Input v-model="data.password"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.password }"
                    id="password"
                    type="password" name="password" placeholder="Enter password"
                    @input="validatePassword($event.target.value)" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.password">
                    <span v-for="(error, index) in errors.password" :key="'password-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
              <div class="flex flex-wrap gap-2 mt-2">
                <Badge v-for="(value, index) in passwordRequirements" :class="{ 'disabled': !value.isValid }" :key="index">
                  <template #icon>
                    <CheckIcon class="size-4" />
                  </template>
                  {{ value.text }}
                </Badge>
              </div>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="password">
                Repeat Password <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.password_confirmation" :show_eye_icon="true">
                <template #input :errors="errors.password_confirmation">
                  <Input v-model="data.password_confirmation"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.password_confirmation }"
                    id="password_confirmation"
                    type="password" name="password_confirmation" placeholder="Enter password confirmation" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.password_confirmation">
                    <span v-for="(error, index) in errors.password_confirmation" :key="'password_confirmation-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="col-span-2">
              <button type="submit"
                class="w-full rounded-xl items-center bg-secondary px-4 py-2 bg-gray-900 border border-transparent rounded-lg font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
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

<script setup>
import { ref } from 'vue'
import SolidFireworks from '@/assets/solid-fireworks.svg'
import SolidMail from '@/assets/solid-mail.svg'
import { ExclamationTriangleIcon, ArrowLongRightIcon, CheckIcon } from '@heroicons/vue/24/solid'
import { ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/outline'
import Badge from '@/components/Badge.vue'

const passwordRequirements = ref({
  lengthValid: {
    text: "Minimum 8 characters",
    isValid: false,
    test: (password) => password.length >= 8,
  },
  uppercaseValid: {
    text: "Uppercase",
    isValid: false,
    test: (password) => /[A-Z]/.test(password),
  },
  numberValid: {
    text: "Number",
    isValid: false,
    test: (password) => /\d/.test(password),
  },
  specialCharValid: {
    text: "At least 1 special character",
    isValid: false,
    test: (password) => /[<>?,./:";'{}|[\]\\!@#$%^&*()_+]/.test(password),
  },
});

const validatePassword = (value) => {
  Object.values(passwordRequirements.value).forEach((requirement) => {
    requirement.isValid = requirement.test(value);
  });
};
</script>

<script>
import { mapActions } from 'pinia'
import { useAuthStore } from '@/stores/auth.js'
import Logo from '@/components/Logo.vue'
import SearchDropdown from '@/components/SearchDropdown.vue'
import VueInputDropdown from 'vue-input-dropdown'
import Multiselect from 'vue-multiselect'
import { debounce } from 'lodash';
import Input from '@/components/Input.vue'
import InputValidation from '@/components/InputValidation.vue'

export default {
  data: () => {
    return {
      data: {
        firstname: null,
        lastname: null,
        business_name: null,
        email: null,
        phone_number: null,
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
      },
      isModalOpen: false,
      slides: [
        { image: 'https://via.placeholder.com/600x300/FF5733/FFFFFF?text=Slide+1' },
        { image: 'https://via.placeholder.com/600x300/33FF57/FFFFFF?text=Slide+2' },
      ],
      currentSlide: 0, // Current slide index
    }
  },
  components: {
    Logo,
    SearchDropdown,
    VueInputDropdown,
    Multiselect,
    Input,
    InputValidation
  },
  computed: {
    currentUser() {
      return useAuthStore().currentUser
    }
  },
  methods: {
    ...mapActions(useAuthStore, ['attempt_user']),
    redirectToHome() {
      this.$router.push({ name: 'Home' })
    },
    register() {
      this.errors = null

      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/register', this.data)
          .then((response) => {
            this.attempt_user()
              .then(() => {
                // this.isModalOpen = true;
                this.$router.push({ name: 'Home' })
              })
              .catch((error) => {
                console.error(error);
              })
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          })
      });
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
    }, 500), // 500ms debounce time
    openModal() {
      this.isModalOpen = true; // Open the modal
    },
    closeModal() {
      this.isModalOpen = false; // Close the modal
    },
    goToSlide(index) {
      this.currentSlide = index;
    },
  },
  computed: {
    sliderStyle() {
      return {
        // width: `${this.slides.length * 100}%`,
        display: 'flex',
      };
    },
  },
  mounted() {
    this.getBusinessTypes()
    this.getBusinessFeatures()
  },
}
</script>
<style scoped>
/* Optional: Add custom fade-in animation for modal */
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.animate__fadeIn {
  animation: fadeIn 0.3s ease-out;
}
</style>