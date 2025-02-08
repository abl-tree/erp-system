<template>
    <textarea class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"
    v-bind="$attrs" 
    :value="modelValue" 
    @input="$emit('update:modelValue', $event.target.value)"></textarea>
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