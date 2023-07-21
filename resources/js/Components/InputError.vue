<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message" class="">
        <div class="text-sm p-1 text-red-600 w-1/6 text-center">
            {{ message }}
        </div>
    </div>
</template>
