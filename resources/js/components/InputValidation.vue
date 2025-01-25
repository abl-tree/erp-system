<template>
<div class="relative input-validation">
  <slot name="input"></slot>
  <div class="flex flex-row gap-1 absolute top-0 right-0 mt-3 mr-3">
    <ExclamationTriangleIcon v-if="has_error" class="size-5 text-red-700 select-none" />
    <EyeIcon v-if="show_eye_icon && show_password" @click="togglePassword($event.target, false)" class="size-5 cursor-pointer select-none" />
    <EyeSlashIcon v-else-if="show_eye_icon && !show_password" @click="togglePassword($event.target, true)" class="size-5 cursor-pointer select-none" />
  </div>
  <slot name="errors"></slot>
</div>
</template>

<script setup>
import { ref } from 'vue'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/solid'
import { EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/outline'
import $ from 'jquery';

const props = defineProps({
  has_error: {
    type: Boolean,
    default: false
  },
  show_eye_icon: {
    type: Boolean,
    default: false
  }
})

const show_password = ref(false)

const togglePassword = (target, toggle = false) => {
  console.log(target, toggle);
  
  const input = $(target).closest('.input-validation').find('input')
  
  show_password.value = toggle

  if (toggle) {
    input.prop('type', 'text')
  } else {
    input.prop('type', 'password')
  }
}
</script>