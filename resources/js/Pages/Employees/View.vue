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
        default: () => [],
    },
    departments: {
        type: Object,
        default: () => ({}),
    },
    positions: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <NavbarLayout title="Edit Employee">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Employee <span class="text-slate-400"> / View</span>
                </h3>
            </div>
        </template>
        <FormLayout :employee="employee" :allEmployees="allEmployees" :departments="departments" :positions="positions"
            readonly>
        </FormLayout>
    </NavbarLayout>
</template>