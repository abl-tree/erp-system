<template>
    <span class="flex flex-row rounded-2xl success px-3 py-1 text-sm gap-1">
        <div class="self-center icon">
            <slot name="icon" />
        </div>
        <slot />
    </span>
</template>

<style scoped>
    .success {
        @apply bg-[#6FAF0033] text-[#6FAF0099] px-3 py-1 text-sm;
        .icon {
            @apply text-[#6FAF00];
        }
    }

    .disabled {
        @apply bg-[#76767633] text-[#76767699] px-3 py-1 text-sm;
        .icon {
            @apply text-[#767676];
        }
    }
</style>