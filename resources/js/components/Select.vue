<template>
  <select
    class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"
    v-bind="$attrs"
    :value="modelValue"
    @change="onChange"
  >
    <option v-if="label" :key="0" :value="0">{{ label }}</option>
    <option
      v-for="(option, key) in options"
      :key="key+1"
      :value="option.id"
    >
      {{ option.name }}
    </option>
  </select>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: [String, Number],
      default: 0,
    },
    options: {
      type: Array,
      required: true,
    },
    label: {
      type: String,
      default: null,
    },
  },
  methods: {
    onChange(event) {
      const value = event.target.value === "null" ? null : event.target.value;
      this.$emit("update:modelValue", value);      
    },
  },
};
</script>

<script setup>

const props = defineProps(['modelValue', 'options', 'label']);

</script>

<style scoped>
.custom-invalid {
  @apply border-red-700 bg-red-700/15 placeholder-red-500;
}
</style>