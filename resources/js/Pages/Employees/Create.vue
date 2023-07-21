<script setup>
import NavbarLayout from '@/Layouts/Navigations/NavbarLayout.vue';
import FormLayout from '@/Pages/Employees/Layouts/FormLayout.vue';

const props = defineProps({
    employee: {
        type: Object,
        default: () => ({}),
    },
    allEmployees: {
        type: Object,
        default: () => ({}),
    },
    departments: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <NavbarLayout title="Employees">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Employees <span class="text-slate-400"> / New</span>
                </h3>
            </div>
            <hr>
            <div class="uppercase text-[13px] text-[#7a61ab] font-semibold pt-2">Launch plan</div>
        </template>
        <FormLayout v-bind="$props"></FormLayout>
    </NavbarLayout>
</template>
