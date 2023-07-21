<script setup>
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
        <div class="w-full">
            <div class="my-1 mx-2 ">
                <div class="grid grid-cols-5 gap-0 w-full">
                    <div v-for="employee in employees" :key="employee.id">
                        <Link :href="route('employees.edit', employee.id)">
                        <div class="my-3 mx-2 bg-white h-28 flex rounded-md shadow-sm border-[1px]">
                            <div class="h-full bg-pink-500 w-1/3 rounded-md flex items-center justify-center">poto</div>
                            <div class="m-3 items-center text-sm">
                                <div class="font-bold">{{ employee.name }}</div>
                                <div>{{ employee.position.name }}</div>
                                <div class="mt-2">{{ employee.email }}</div>
                                <div>{{ employee.mobile }}</div>
                            </div>
                        </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>