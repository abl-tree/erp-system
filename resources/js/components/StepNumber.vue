<template>
    <div class="flex flex-col items-center gap-3">
        <div class="bg-accent text-2xl text-white rounded-full w-10 h-10 flex items-center justify-center">{{number}}</div>
        <div class="flex-1 border-black border-s w-px"></div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

// Define props
const props = defineProps({
  number: {
    type: Number,
    default: 1 // Default value for 'number'
  }
});
</script>