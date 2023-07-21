<script setup>
import NavbarLayout from '@/Layouts/Navigations/NavbarLayout.vue';
import FormLayout from '@/Pages/Positions/Layouts/FormLayout.vue';

const props = defineProps({
    position: {
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
    <NavbarLayout title="View Job Position">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Job Position <span class="text-slate-400"> / View</span>
                </h3>
            </div>
        </template>
        <FormLayout :position="position" :allDepartments="allDepartments" readonly></FormLayout>
    </NavbarLayout>
</template>