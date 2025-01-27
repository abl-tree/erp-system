<template>
  <div class="grid grid-cols-5 min-h-screen h-full">
    <div class="relative bg-primary col-span-2">
      <div class="absolute inset-0 bg-register-img bg-no-repeat bg-cover bg-right-top opacity-10 min-h-screen"></div>
      <div class="relative text-white h-full w-full flex flex-col justify-center items-center">
        <div class="text-2xl">Header Something</div>
        <div class="px-28 py-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero vulputate at. Donec et orci vel turpis luctus malesuada ac ut nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis elit dui, id mollis mauris tincidunt consequat. Nam fringilla suscipit varius.</div>
      </div>
    </div>
    <div class="col-span-3 flex flex-col py-10 px-5">
      <div class="flex-none flex flex-row justify-end">
        <logo></logo>
      </div>
      <div class="flex-grow p-10">
        <form @submit.prevent="register">
          <div class="grid grid-cols-3 gap-5">
            <div class="col-span-3 flex flex-col justify-center items-center gap-10">
              <UserIcon class="size-10 text-gray-800 text-secondary" />
              <span>Complete User Account</span>
            </div>
            <div class="col-span-3"><hr></div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="gender">
                Gender <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.gender">
                <template #input :errors="errors.gender">
                  <Input v-model="data.gender"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.gender }"
                    id="gender"
                    type="gender" name="gender" placeholder="Enter gender" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.gender">
                    <span v-for="(error, index) in errors.gender" :key="'gender-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="birthdate">
                Birthdate <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.birthdate">
                <template #input :errors="errors.birthdate">
                  <Input v-model="data.birthdate"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.birthdate }"
                    id="birthdate"
                    type="birthdate" name="birthdate" placeholder="Enter birthdate" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.birthdate">
                    <span v-for="(error, index) in errors.birthdate" :key="'birthdate-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="citizenship">
                Citizenship <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.citizenship">
                <template #input :errors="errors.citizenship">
                  <Input v-model="data.citizenship"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.citizenship }"
                    id="citizenship"
                    type="citizenship" name="citizenship" placeholder="Enter citizenship" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.citizenship">
                    <span v-for="(error, index) in errors.citizenship" :key="'citizenship-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="col-span-3">
              <label class="block font-medium text-sm text-gray-500" for="password">
                Password <span class="text-red-500">*</span>
              </label>
              <InputValidation ref="passwordValidation" :has_error="errors && errors.password" :show_eye_icon="true" :password_validation="true">
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
            </div>
            <div class="col-span-3">
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
            <div class="col-span-3">
              <button type="submit"
                class="w-full rounded-xl items-center bg-secondary px-4 py-2 bg-gray-900 border border-transparent rounded-lg font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Register
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import SolidFireworks from '@/assets/solid-fireworks.svg'
import SolidMail from '@/assets/solid-mail.svg'
import { ExclamationTriangleIcon, ArrowLongRightIcon, CheckIcon, UserIcon } from '@heroicons/vue/24/solid'
import { ArrowRightStartOnRectangleIcon } from '@heroicons/vue/24/outline'
import Badge from '@/components/Badge.vue'
import Logo from '@/components/Logo.vue'
import Input from '@/components/Input.vue'
import InputValidation from '@/components/InputValidation.vue'

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
    test: (password) => /[!@#$%^&*]/.test(password),
  },
});
const passwordValidation = ref(null);

const data = ref({
  password: null,
  password_confirmation: null,
})

const errors = ref(null)

const validatePassword = (value) => {
  passwordValidation.value?.validatePassword(value);
};
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