<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue'
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
// import {
//     Combobox,
//     ComboboxInput,
//     ComboboxOptions,
//     ComboboxOption,
// } from '@headlessui/vue'

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
    readonly: {
        type: Boolean,
        default: false,
    }
});

const form = useForm("Create", {
    id: props.department.id ?? 0,
    name: props.department.name ?? '',
    manager_id: props.department.manager_id ?? '',
    parent_id: props.department.parent_id ?? '',
});

const submit = () => {
    if (form.id === 0) {
        delete form.id
        form.post(route("departments.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            },
        });
    }
    else {
        form.put(route("departments.update", props.department.id))
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})

</script>

<template>
    <div class="flex h-screen bg-violet-300">
        <div class="m-4 bg-white rounded-md w-full h-1/3">
            <form @submit.prevent="submit" class="w-full">
                <div class="mx-9 mt-4 grid grid-rows-5 grid-flow-col gap-0">
                    <div class="text-sm font-medium flex items-center ">
                        <input type="text" v-model="form.name"
                            class="border-0 h-12 w-full text-3xl hover:border-b-[1px] focus:ring-0 focus:border-slate-500 placeholder-slate-300"
                            placeholder="Department's Name" :disabled="readonly">
                        <!-- <InputError :message="form.errors.name"></InputError> -->
                    </div>
                    <div class="mt-10">
                        <h3 class="text-sm uppercase font-bold text-slate-500">Department Detail</h3>
                        <hr>
                    </div>
                    <div class="grid grid-rows-1 grid-flow-col">
                        <div class="text-sm font-medium flex items-center mr-8">
                            <InputLabel class="w-20">Manager </InputLabel>
                            <select type="text" id="employees" v-model="form.manager_id" :disabled="readonly"
                                class="border-0 text-sm h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin">
                                <option disabled selected class="text-sm" v-bind:value="''">Select Manager</option>
                                <option v-for="manager in employees" v-bind:value="manager.id">
                                    {{ manager.name }}
                                </option>
                            </select>
                        </div>
                        <div class="text-sm font-medium flex items-center ">
                            <InputLabel class="w-40">Parent Department </InputLabel>
                            <select type="text" id="departments" v-model="form.parent_id" :disabled="readonly"
                                class="border-0 text-sm h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 font-thin">
                                <option disabled selected class="text-sm border-0" v-bind:value="''">Select Parent
                                    Department
                                </option>
                                <option v-for="oneDepartment in allDepartments" v-bind:value="oneDepartment.id"
                                    class="text-sm border-0">
                                    {{ oneDepartment.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-end mt-14">
                            <button v-if="!readonly" class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">{{ buttonLabel
                                }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>