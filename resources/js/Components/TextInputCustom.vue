<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,

    readonly: {
        type: Boolean,
        default: false,
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input ref="input" type="text"
        class="mx-5 border-0 h-7 hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin text-sm"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :disabled="readonly">
</template>