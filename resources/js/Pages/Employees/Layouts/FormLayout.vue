<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, onMounted, ref, watch } from 'vue';
import TextInputCustom from '@/Components/TextInputCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    employee: {
        type: Object,
        default: () => ({}),
    },
    allEmployees: {
        type: Object,
        default: () => ({}),
    },
    departments: {
        type: Object,
        default: () => ({}),
    },
    positions: {
        type: Object,
        default: () => ({}),
    },
    readonly: {
        type: Boolean,
        default: false,
    }
});

const form = useForm({
    id: props.employee.id ?? 0,
    name: props.employee.name ?? '',
    mobile: props.employee.mobile ?? '',
    phone: props.employee.phone ?? '',
    email: props.employee.email ?? '',
    tag: props.employee.tag ?? '',
    department_id: props.employee.department_id ?? '',
    position_id: props.employee.position_id ?? '',
    manager_id: props.employee.manager_id ?? '',
    coach_id: props.employee.coach_id ?? '',
});

console.log()

const submit = () => {
    if (form.id === 0) {
        form.post(route("employees.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            },
        });
    }
    else {
        form.put(route("employees.update", props.employee.id))
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})

const positions = ref([])

watch(() => form.department_id, (value) => {
    axios.get('/api/job-positions?department_id=' + value)
        .then((response) => {
            // console.log(response.data)
            positions.value = response.data

            form.position_id = ''
        })
})

onMounted(() => {
    axios.get('/api/job-positions?department_id=' + props.employee.department_id)
        .then((response) => {
            // console.log(response.data)
            positions.value = response.data
        })
})
</script>

<template>
    <div class="flex justify-center h-screen bg-violet-300">
        <div class="m-4 w-screen h-3/4 bg-white rounded-md">
            <form @submit.prevent="submit">
                <div class="mt-4 mx-9 grid grid-rows-3 grid-flow-col">
                    <div>
                        <input v-model="form.name" type="text" :disabled="readonly"
                            class="border-0 h-12 w-full text-3xl hover:border-b-[1px] focus:ring-0 focus:border-slate-500 placeholder-slate-300"
                            placeholder="Employee's Name">
                        <InputError :message="form.errors.name">{{ form.errors.name }}</InputError>
                    </div>
                    <div>
                        <input v-model="form.tag" type="text" :disabled="readonly"
                            class="border-0 hover:border-b-[1px] focus:ring-0 focus:border-slate-500 placeholder-slate-300"
                            placeholder="Tags">
                        <InputError :message="form.errors.tag">{{ form.errors.tag }}</InputError>
                    </div>
                </div>

                <div class=" grid grid-rows-2 grid-flow-col gap-0 ">
                    <div class="">
                        <div class="mx-9">
                            <h3 class="uppercase text-sm text-slate-500 font-bold">Position</h3>
                            <hr>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center">
                            <InputLabel>Department </InputLabel>
                            <select type="text" id="departments" v-model="form.department_id" :disabled="readonly"
                                class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm">
                                <option value="" disabled selected class="text-sm border-0">Select Department</option>
                                <option v-for="department in departments" v-bind:value="department.id"
                                    class="text-sm border-0 ">
                                    {{ department.name }}
                                </option>
                            </select>
                            <!-- <InputError :message="form.errors.department_id">{{ form.errors.department_id }}
                            </InputError> -->
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center">
                            <InputLabel>Job Position</InputLabel>
                            <select type="text" id="position" v-model="form.position_id" :disabled="readonly"
                                class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm">
                                <option value="" disabled selected class="text-sm border-0">Select Job Position</option>
                                <option v-for="position in positions" v-bind:value="position.id" class="text-sm border-0">
                                    {{ position.name }}
                                </option>
                            </select>
                            <!-- <InputError :message="form.errors.position">{{ form.errors.position }}</InputError> -->
                        </div>
                    </div>

                    <div class="">
                        <div class="mx-9">
                            <h3 class="font-bold text-sm uppercase text-slate-500">Work Information</h3>
                            <hr>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center h-10">
                            <InputLabel>Work Mobile</InputLabel>
                            <TextInputCustom v-model="form.mobile" class="w-full" :disabled="readonly"></TextInputCustom>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center h-10">
                            <InputLabel>Work Phone</InputLabel>
                            <TextInputCustom v-model="form.phone" class="w-full" :disabled="readonly"></TextInputCustom>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center h-10">

                            <InputLabel>Work Email</InputLabel>
                            <TextInputCustom v-model="form.email" class="w-full" :disabled="readonly"></TextInputCustom>
                        </div>
                    </div>

                    <div class="">
                        <div class="mx-9">
                            <h3 class="text-sm font-bold text-slate-500 uppercase">Person Responsible</h3>
                            <hr>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center h-10">
                            <InputLabel>Manager</InputLabel>
                            <select type="text" id="departments" v-model="form.manager_id" :disabled="readonly"
                                class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm">
                                <option value="" disabled selected class="text-sm border-0">Select Manager</option>
                                <option v-for="oneEmployee in allEmployees" v-bind:value="oneEmployee.id"
                                    class="text-sm border-0">
                                    {{ oneEmployee.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mx-9 text-sm font-medium flex items-center h-10">
                            <InputLabel>Coach</InputLabel>
                            <select type="text" id="departments" v-model="form.coach_id" :disabled="readonly"
                                class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm">
                                <option value="" disabled selected class="text-sm border-0">Select Coach</option>
                                <option v-for="oneEmployee in allEmployees" v-bind:value="oneEmployee.id"
                                    class="text-sm border-0">
                                    {{ oneEmployee.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <div class="mx-9 text-sm font-medium flex items-center h-10">
                    <label class="w-36 font-thin text-slate-600">Work Information </label>
                </div>
                <div class="my-3 grid grid-rows-3 grid-flow-col gap-2">
                    <div class="mx-9 text-sm font-medium flex items-center h-10">
                        <label class="text-slate-700 w-full border-b-2 uppercase text-xs font-extrabold">Location</label>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-10">
                        <label class="w-36 font-bold">Work Address </label>
                        <input type="text"
                            class="border-0 focus:ring-0 focus:border-slate-500 h-10 w-full hover:border-b-[1px]">
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-10">
                        <label class="w-36 font-bold">Work Location</label>
                        <input type="text"
                            class="border-0 focus:ring-0 focus:border-slate-500 h-10 w-full hover:border-b-[1px]">
                    </div>
                </div>
                <div class="my-3 grid grid-rows-4 grid-flow-col gap-2">
                    <div class="mx-9 text-sm font-medium flex items-center h-10">
                        <label class="text-slate-700 w-full border-b-2 uppercase text-xs font-extrabold">Schedule</label>
                    </div>
                    <div class="mx-9 text-sm font-medium flex items-center h-10">
                        <label class="w-36 font-bold">Working Hours</label>
                        <input type="text"
                            class="border-0 h-10 w-1/6 hover:border-b-[1px] focus:ring-0 focus:border-slate-500">
                    </div>
                </div> -->
                <div>
                    <div class="flex justify-end">
                        <button v-if="!readonly" class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">{{ buttonLabel
                            }}</button>
                    </div>
                </div>
                <!-- </div> -->
            </form>
        </div>
    </div>
</template>