<template>
<div class="relative input-validation">
  <slot name="input"></slot>
  <div class="flex flex-row gap-1 absolute top-0 right-0 mt-3 mr-3">
    <ExclamationTriangleIcon v-if="has_error" class="size-5 text-red-700 select-none" />
    <EyeIcon v-if="show_eye_icon && show_password" @click="togglePassword($event.target, false)" class="size-5 cursor-pointer select-none" />
    <EyeSlashIcon v-else-if="show_eye_icon && !show_password" @click="togglePassword($event.target, true)" class="size-5 cursor-pointer select-none" />
  </div>
  <div v-if="password_validation" class="flex flex-wrap gap-2 mt-2">
    <Badge v-for="(value, index) in passwordRequirements" :class="{ 'disabled': !value.isValid }" :key="index">
      <template #icon>
        <CheckIcon class="size-4" />
      </template>
      {{ value.text }}
    </Badge>
  </div>
  <slot name="errors"></slot>
</div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { ExclamationTriangleIcon, CheckIcon } from '@heroicons/vue/24/solid'
import { EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/outline'
import Badge from '@/components/Badge.vue'
import Logo from '@/components/Logo.vue'
import $ from 'jquery';

const props = defineProps({
  has_error: {
    type: Boolean,
    default: false
  },
  show_eye_icon: {
    type: Boolean,
    default: false
  },
  password_validation: {
    type: Boolean,
    default: false
  },
  test: {
    type: String,
    default: ''
  }
})

const show_password = ref(false)

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

const togglePassword = (target, toggle = false) => {  
  const input = $(target).closest('.input-validation').find('input')
  
  show_password.value = toggle

  if (toggle) {
    input.prop('type', 'text')
  } else {
    input.prop('type', 'password')
  }
}

const validatePassword = (value) => {
  const allValid = Object.values(passwordRequirements.value).every((requirement) => {
    requirement.isValid = requirement.test(value);
    return requirement.isValid;
  });  

  return allValid;
};

defineExpose({
  validatePassword,
});
</script>