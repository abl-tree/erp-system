<template>
    <select>
        <option value="">Select an option</option>
        <option v-for="option in options" :key="option.id" :value="option.id">{{ option.name }}</option>
    </select>
</template>

<script lang="ts">
interface Option {
    id: number;
    name: string;
}

export default {
    props: {
        options: {
            type: Array as PropType<Option[]>,
            required: true,
        },
    },
    data() {
        return {
            selected: '',
        }
    }
}
</script>