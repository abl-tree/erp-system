<template>
  <div class="flex flex-row">
    <button class="rounded-l-lg bg-secondary p-2 text-xs font-bold" @click="add">Add New</button>
    <button class="relative rounded-r-lg bg-white p-2 text-xs font-bold" @click="toggleDropdown">
        <ChevronDownIcon  class="size-5 text-accent" />
        <!-- Dropdown Menu -->
        <div
            v-if="showDropdown"
            class="absolute right-0 z-10 mt-2 bg-white border border-gray-300 rounded-lg shadow-lg"
        >
            <ul>
            <li
                v-for="(option, index) in options"
                :key="index"
                @click="selectOption(option)"
                class="px-4 py-2 text-black cursor-pointer hover:bg-blue-500 hover:text-white"
            >
                {{ option }}
            </li>
            </ul>
        </div>
    </button>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue'
import { MagnifyingGlassIcon, ChevronRightIcon, ChevronDownIcon, XMarkIcon } from '@heroicons/vue/24/solid'

const emit = defineEmits(['add'])

const query = ref("");
const showDropdown = ref(false);
const options = ref(["Option 1", "Option 2", "Option 3", "Option 4"]);

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

const selectOption = (option) => {
  query.value = option; // Set the input value to the selected option
  showDropdown.value = false; // Close the dropdown
};

const add = () => {
  emit('add');
};
</script>

<style scoped>
/* Optionally add some custom styles for the dropdown */
</style>
