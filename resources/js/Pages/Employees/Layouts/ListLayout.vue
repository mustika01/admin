<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import { Link, useForm } from '@inertiajs/vue3';

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

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('employees.destroy', id));
    }
}
const form = useForm({});

</script>

<template>
    <div class="">
        <table class="w-full">
            <thead class="text-sm">
                <tr class="bg-gray-100">
                    <th class="pl-6 py-3 text-left border-x-[1px] flex">
                        <Checkbox></Checkbox>
                        <div class="pl-2">Employee Name</div>
                    </th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Work Phone</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Work Email</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Department</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Job Position</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Manager</th>
                    <th class="px-1 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employee in employees" :key="employee.id" class="bg-white border-b text-sm">
                    <td class="pl-6 py-2 text-left flex">
                        <Checkbox></Checkbox>
                        <div class="pl-2">{{ employee.name }}</div>
                    </td>
                    <td class="px-1 py-2 text-left">{{ employee.mobile }}</td>
                    <td class="px-1 py-2 text-left">{{ employee.email }}</td>
                    <td class="px-1 py-2 text-left">{{ employee.department.name }}</td>
                    <td class="px-1 py-2 text-left">{{ employee.position.name }}</td>
                    <td class="px-1 py-2 text-left">{{ employee.manager?.name }}</td>
                    <td class="px-1 py-2 text-center">
                        <Link :href="route('employees.show', employee.id)" class="mx-1 text-slate-600">View</Link>
                        <Link :href="route('employees.edit', employee.id)" class="mx-1 text-green-600">Edit</Link>
                        <Link @click="destroy(employee.id)" class="mx-1 text-red-600">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>