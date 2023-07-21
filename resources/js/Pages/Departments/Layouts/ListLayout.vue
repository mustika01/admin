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
        <table class="w-full">
            <thead class="text-sm">
                <tr class="bg-gray-100">
                    <th class="pl-6 py-3 text-left flex border-x-[1px]">
                        <input type="checkbox" class="appearance-none rounded-[4px] checked:bg-[#7a61ab]" />
                        <div class="ml-4">Display Name</div>
                    </th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Manager</th>
                    <th class="px-1 py-3 text-right border-x-[1px]">Employees</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Parent Department</th>
                    <th class="px-1 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="department in departments" :key="department.id" class="bg-white border-b text-sm">
                    <td class="pl-6 py-2 text-left flex">
                        <input type="checkbox" class="rounded-[4px] checked:bg-[#7a61ab]" />
                        <div class="ml-4">{{ department.name }}</div>
                    </td>
                    <td class="px-1 py-2 text-left">{{ department.manager?.name }}</td>
                    <td class="px-1 py-2 text-right">{{ department.employees_count }}</td>
                    <td class="px-1 py-2 text-left">{{ department.parent?.name }}</td>
                    <td class="px-1 py-2 text-center">
                        <Link :href="route('departments.show', department.id)" class="mx-1 text-slate-600">View</Link>
                        <Link :href="route('departments.edit', department.id)" class="mx-1 text-green-600">Edit</Link>
                        <Link @click="destroy(department.id)" class="mx-1 text-red-600">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>