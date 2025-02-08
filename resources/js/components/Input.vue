<template>
<input class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"
    v-bind="$attrs" 
    :value="modelValue" 
    @input="$emit('update:modelValue', $event.target.value)" />
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props for v-model binding
defineProps({
  modelValue: String
});

// Define emits for v-model updates
defineEmits(['update:modelValue']);
</script>

<style scoped>
input {
    @apply rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50
}

.custom-invalid {
  @apply border-red-700 bg-red-700/15 placeholder-red-500;
}
</style>