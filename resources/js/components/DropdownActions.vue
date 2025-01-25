<template>
  <div class="relative">
    <!-- Dropdown trigger -->
    <button
      ref="trigger"
      @click="toggleDropdown"
      class="focus:outline-none"
    >
      <EllipsisVerticalIcon class="w-5 h-5 text-gray-600 hover:text-gray-800" />
    </button>

    <!-- Dropdown menu -->
    <div
      v-if="isOpen"
      ref="dropdown"
      class="z-10 bg-white border border-gray-300 rounded-lg shadow-lg"
      :class="dropdownClass"
    >
      <ul>
        <li
          v-for="(action, index) in actions"
          :key="index"
          @click="selectAction(action)"
          class="px-4 py-2 text-black cursor-pointer hover:bg-blue-500 hover:text-white"
        >
          {{ action }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import { EllipsisVerticalIcon } from '@heroicons/vue/24/solid';
import { createPopper } from '@popperjs/core';

export default {
  name: 'DropdownActions',
  components: {
    EllipsisVerticalIcon,
  },
  props: {
    actions: {
      type: Array,
      required: true,
    },
  },
  emits: ['actionSelected'],
  setup(props, { emit }) {
    const isOpen = ref(false);
    const trigger = ref(null);
    const dropdown = ref(null);
    const dropdownClass = ref('absolute mt-2 min-w-[8rem]');

    let popperInstance = null;

    const toggleDropdown = async () => {
      isOpen.value = !isOpen.value;

      if (isOpen.value) {
        await nextTick(); // Wait for the dropdown to render
        if (trigger.value && dropdown.value) {
          popperInstance = createPopper(trigger.value, dropdown.value, {
            placement: 'bottom-end',
            modifiers: [
              {
                name: 'preventOverflow',
                options: {
                  boundary: 'viewport', // Prevent overflow outside the viewport
                },
              },
              {
                name: 'offset',
                options: {
                  offset: [0, 8], // Adjust offset if needed
                },
              },
            ],
          });
        }
      } else {
        destroyPopper();
      }
    };

    const selectAction = (action) => {
      emit('actionSelected', action);
      isOpen.value = false; // Close dropdown after selection
      destroyPopper();
    };

    const destroyPopper = () => {
      if (popperInstance) {
        popperInstance.destroy();
        popperInstance = null;
      }
    };

    const handleOutsideClick = (event) => {
      if (
        isOpen.value &&
        trigger.value &&
        dropdown.value &&
        !trigger.value.contains(event.target) &&
        !dropdown.value.contains(event.target)
      ) {
        isOpen.value = false;
        destroyPopper();
      }
    };

    onMounted(() => {
      document.addEventListener('click', handleOutsideClick);
    });

    onUnmounted(() => {
      document.removeEventListener('click', handleOutsideClick);
      destroyPopper();
    });

    return {
      isOpen,
      toggleDropdown,
      selectAction,
      trigger,
      dropdown,
      dropdownClass,
    };
  },
};
</script>

<style scoped>
/* Tailwind CSS styling */
</style>
