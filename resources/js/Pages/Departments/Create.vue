<script setup>
import NavbarLayout from '@/Layouts/Navigations/NavbarLayout.vue';
import FormLayout from '@/Pages/Departments/Layouts/FormLayout.vue';

const props = defineProps({
    department: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },
    allDepartments: {
        type: Object,
        default: () => [],
    },
});

</script>

<template>
    <NavbarLayout title="Department">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Department <span class="text-slate-400"> / New</span>
                </h3>
            </div>
        </template>
        <FormLayout v-bind="$props"></FormLayout>
    </NavbarLayout>
</template>
