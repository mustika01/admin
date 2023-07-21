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
    <NavbarLayout title="Position">
        <template #header>
            <div>
                <h3 class="text-xl leading-tight pb-3 text-[#7a61ab]">
                    Job Position <span class="text-slate-400"> / New</span>
                </h3>
            </div>
        </template>
        <FormLayout v-bind="$props"></FormLayout>
    </NavbarLayout>
</template>
