<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
      <!-- Modal Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-300">
        <h3 class="text-lg font-semibold">Modal Title</h3>
        <button @click="closeModal" class="text-gray-500 hover:text-gray-700">✕</button>
      </div>

      <!-- Modal Body -->
      <div class="p-4">
        <p>This is the modal content.</p>
      </div>

      <!-- Modal Footer -->
      <div class="flex items-center justify-end p-4 border-t border-gray-300">
        <button @click="closeModal" class="px-4 py-2 text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100">
          Cancel
        </button>
        <button @click="confirmAction" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
          Confirm
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

// Define the prop to control modal visibility
defineProps({
  show: {
    type: Boolean,
    required: true,
  },
});

// Emit events to notify the parent
const emit = defineEmits(["close"]);

const closeModal = () => {
  emit("close");
};

const confirmAction = () => {
  alert("Action confirmed!");
  closeModal(); // Close modal after action
};
</script>
