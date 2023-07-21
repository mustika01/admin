<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    positions: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('positions.destroy', id));
    }
}

</script>

<template>
    <div class="flex justify-center">
        <table class="w-full">
            <thead class="text-sm">
                <tr class="bg-gray-100">
                    <th class="pl-6 py-3 text-left flex border-x-[1px]">
                        <input type="checkbox" class="appearance-none rounded-[4px] checked:bg-[#7a61ab]" />
                        <div class="ml-4">Job Position</div>
                    </th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Department</th>
                    <th class="px-1 py-3 text-left border-x-[1px]">Level</th>
                    <th class="px-1 py-3 text-center border-x-[1px]">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="position in positions" :key="position.id" class="bg-white border-b text-sm">
                    <td class="pl-6 py-2 text-left flex">
                        <input type="checkbox" class="rounded-[4px] checked:bg-[#7a61ab]" />
                        <div class="ml-4">{{ position.name }}</div>
                    </td>
                    <td class="px-1 py-2 text-left">{{ position.department.name }}</td>
                    <td class="px-1 py-2 text-left">{{ position.level }}</td>
                    <td class="px-1 py-2 text-center">
                        <Link :href="route('positions.show', position.id)" class="mx-1 text-slate-600">View</Link>
                        <Link :href="route('positions.edit', position.id)" class="mx-1 text-green-600">Edit</Link>
                        <Link @click="destroy(position.id)" class="mx-1 text-red-600">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>