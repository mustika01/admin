<script setup>
import NavbarLayout from '@/Layouts/Navigations/NavbarLayout.vue';
import ListLayout from '@/Pages/Employees/Layouts/ListLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import KanbanLayout from './Layouts/KanbanLayout.vue';
import ApplicationList from '@/Components/ApplicationList.vue';
import ApplicationKanban from '@/Components/ApplicationKanban.vue';
import { ref } from 'vue';

const form = useForm({});

const props = defineProps({
    employees: {
        type: Object,
        default: () => ({}),
    },
    positions: {
        type: Object,
        default: () => ({}),
    },
});

const tableLayout = ref('kanban')
</script>

<template>
    <NavbarLayout title="Employees">
        <template #header>
            <div class="grid grid-cols-2 grid-flow-row">
                <div class="">
                    <h2 class="text-xl text-gray-800 leading-tight pb-[6px]">
                        Employees
                    </h2>
                    <Link :href="route('employees.create')">
                    <PrimaryButton @click="create = !create" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        NEW
                    </PrimaryButton>
                    </Link>
                </div>
                <div class="flex gird place-items-end justify-end gap-0">
                    <div class="mx-3">
                        <ApplicationKanban @click="tableLayout = 'kanban'"></ApplicationKanban>
                    </div>
                    <div class="">
                        <ApplicationList @click="tableLayout = 'list'"></ApplicationList>
                    </div>
                </div>
            </div>
        </template>
        <ListLayout v-bind="$props" v-if="tableLayout === 'list'"></ListLayout>
        <KanbanLayout v-bind="$props" v-if="tableLayout === 'kanban'"></KanbanLayout>
    </NavbarLayout>
</template>