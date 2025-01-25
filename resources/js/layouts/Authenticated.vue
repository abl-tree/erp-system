<template>
  <main class="flex min-h-screen h-full">
    <!-- <navigation></navigation> -->
    <Sidebar /> 
    <div class="flex-1">
      <div class="w-full h-full bg-primary flex flex-col py-20 px-10" v-if="requiredChangePassword">
        <h2 class="text-xl font-bold text-white">Welcome, User</h2>
        <h3 class="text-white">{{ authStore.currentUser?.email }}</h3>
        <div class="grow flex flex-col items-center pt-10">
          <div class="flex flex-col min-h-10 w-9/12 bg-white rounded-2xl p-20 gap-5">
            <div class="text-center text-xl text-primary font-bold">Complete your user account</div>
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
                    type="password" name="password" placeholder="Enter password" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.password">
                    <span v-for="(error, index) in errors.password" :key="'password-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <label class="block font-medium text-sm text-gray-500" for="password">
                Confirm Password <span class="text-red-500">*</span>
              </label>
              <InputValidation :has_error="errors && errors.password" :show_eye_icon="true">
                <template #input :errors="errors.password">
                  <Input v-model="data.password"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.password }"
                    id="password"
                    type="password" name="password" placeholder="Enter password" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.password">
                    <span v-for="(error, index) in errors.password" :key="'password-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div>
              <button @click="submit" class="bg-secondary text-white p-2 rounded-xl w-full">Save</button>
            </div>
          </div>
        </div>
      </div>
      <router-view v-else></router-view>
    </div>
  </main>
</template>

<script setup>
import { computed, ref } from 'vue'
import Navigation from '@/components/Navigation.vue'
import Sidebar from '@/components/Sidebar.vue'
import { useAuthStore } from '@/stores/auth.js'
import Input from '@/components/Input.vue'
import InputValidation from '@/components/InputValidation.vue'

const authStore = useAuthStore()

const requiredChangePassword = computed(() => {  
  return authStore.currentUser?.password_updated_at == null && authStore.currentUser?.user_role_id == null && false;
})

const data = ref({
  password: '',
  password_confirmation: '',
})
const errors = ref(null)

</script>
