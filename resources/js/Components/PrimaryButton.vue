<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center px-2 py-[6px] bg-[#7a61ab] border border-transparent rounded-[4px] font-semibold text-xs text-white uppercase hover:bg-[#614a8c] focus:bg-[#614a8c] active:bg-[#614a8c] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
