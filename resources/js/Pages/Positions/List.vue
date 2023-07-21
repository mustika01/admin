<script setup>
import NavbarLayout from '@/Layouts/Navigations/NavbarLayout.vue';
import ListLayout from '@/Pages/Positions/Layouts/ListLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    positions: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});
</script>


<template>
    <NavbarLayout title="Positions">
        <template #header>
            <div>
                <h2 class="text-xl text-gray-800 leading-tight pb-[6px]">
                    Job Position
                </h2>
                <Link :href="route('positions.create')">
                <PrimaryButton @click="create = !create" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    NEW
                </PrimaryButton>
                </Link>
            </div>
        </template>
        <ListLayout v-bind="$props"></ListLayout>
    </NavbarLayout>
</template>
