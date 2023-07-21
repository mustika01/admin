<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    departments: {
        type: Object,
        default: () => ({}),
    },
    employees: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('departments.destroy', id));
    }
}
</script>

<template>
    <div class="">
        <div class="py-1">
            <div class="m-3 grid grid-cols-4 gap-2">
                <div v-for="department in departments" :key="department.id">
                    <div class="bg-white h-[140px] mx-1 my-1 p-3 rounded-md border-[1px] shadow-sm">
                        <Link :href="route('departments.edit', department.id)">{{ department.name }}</Link>
                        <div
                            class="bg-[#7a61ab] w-28 text-sm font-bold rounded-sm mt-3 p-1 uppercase text-white text-center">
                            {{ department.employees_count }}
                            Employees
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>