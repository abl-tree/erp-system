<template>
  <div class="flex flex-row">
    <button class="rounded-l-lg bg-secondary p-2 text-xs font-bold">Add New</button>
    <button class="relative rounded-r-lg bg-secondary p-2 text-xs font-bold" @click="toggleDropdown">
        Add New
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

<script>
export default {
  data() {
    return {
      query: "",
      showDropdown: false,
      options: ["Option 1", "Option 2", "Option 3", "Option 4"],
    };
  },
  methods: {
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    selectOption(option) {
      this.query = option; // Set the input value to the selected option
      this.showDropdown = false; // Close the dropdown
    },
  },
};
</script>

<style scoped>
/* Optionally add some custom styles for the dropdown */
</style>
