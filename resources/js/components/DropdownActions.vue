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
      class="z-10 bg-white rounded-xl shadow-lg w-40"
      :class="dropdownClass"
    >
      <ul class="rounded-xl border border-primary">
        <li
          v-for="(option, index) in options"
          :key="index"
          @click="selectAction(option.key, index)"
          @mouseover="option.hovered = true"
          @mouseleave="option.hovered = false"
          class="px-4 py-2 text-sm text-black border border-primary cursor-pointer first:rounded-t-xl last:rounded-b-xl hover:bg-secondary hover:text-white"
        >
          <div class="flex flex-row items-center gap-2">
            <div class="flex-none">
              <component :is="option.solid" :class="{
                'text-secondary': !option.hovered,
                'text-white': option.hovered,
              }" class="size-4" />
            </div>
            <div class="flex-grow">{{ option.value }}</div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import { EllipsisVerticalIcon, EyeIcon, PencilSquareIcon, TrashIcon, UserMinusIcon, UserPlusIcon } from '@heroicons/vue/24/solid';
import { EyeIcon as EyeOutlineIcon, PencilSquareIcon as PencilSquareOutlineIcon } from '@heroicons/vue/24/outline';
import { createPopper } from '@popperjs/core';

export default {
  name: 'DropdownActions',
  components: {
    EllipsisVerticalIcon,
    EyeIcon,
    EyeOutlineIcon,
    PencilSquareIcon,
    PencilSquareOutlineIcon,
    TrashIcon,
    UserMinusIcon,
    UserPlusIcon
  },
  props: {
    actions: {
      type: Object,
      required: true,
    },
  },
  emits: ['actionSelected'],
  data() {
    return {
      options: Object.entries(this.actions).map(([key, value]) => {
        let outline, solid;
        switch (key) {
          case 'view':
              outline = EyeOutlineIcon;
              solid = EyeIcon;
            break;
            
          case 'edit':
              outline = PencilSquareOutlineIcon;
              solid = PencilSquareIcon;
            break;
            
          case 'delete':
              outline = EyeOutlineIcon;
              solid = TrashIcon;
            break;

          case 'disabled':
              outline = EyeOutlineIcon;
              solid = UserMinusIcon;
            break;

          case 'enable':
              outline = EyeOutlineIcon;
              solid = UserPlusIcon;
            break;
        
          default:
            break;
        }

        return {
          key: key,
          value: value,
          solid: solid, // Use the actual component for the solid icon
          outline: outline, // Use the actual component for the outline icon
          hovered: ref(false), // Store the `hovered` state here as a reactive ref
        }
      })
    };
  },
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

    const selectAction = (action, index) => {      
      emit('actionSelected', action, index);
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
