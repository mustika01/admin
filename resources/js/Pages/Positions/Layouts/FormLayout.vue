<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextInputCustom from '@/Components/TextInputCustom.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    position: {
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
    id: props.position.id ?? 0,
    name: props.position.name ?? '',
    department_id: props.position.department_id ?? '',
    level: props.position.level ?? '',
    summary: props.position.summary ?? '',
});

const submit = () => {
    if (form.id === 0) {
        form.post(route("positions.store"), {
            onSuccess: () => {
                form.reset()
                delete form.id
            },
        });
    }
    else {
        form.put(route("positions.update", props.position.id))
    }
};

const buttonLabel = computed(() => {
    return form.id === 0 ? 'create' : 'update'
})
</script>

<template>
    <div class="flex h-screen bg-violet-300">
        <div class="m-4 w-full bg-white rounded-md  h-1/3">
            <form @submit.prevent="submit" class="mt-6">
                <div class="grid grid-rows-2 gap-0.001">
                    <input type="text" v-model="form.name"
                        class="mx-9 border-0 h-12 text-3xl hover:border-b-[1px] focus:ring-0 focus:border-slate-500 placeholder-slate-300 border-b-[1px] border-slate-100"
                        placeholder="Job Position Name" :disabled="readonly">
                    <input type="text" v-model="form.level"
                        class="mx-9 m-2 border-0 h-5 w-1/4 text-md hover:border-b-[1px] focus:ring-0 focus:border-slate-500 placeholder-slate-300 "
                        placeholder="Level" :disabled="readonly">
                </div>
                <div class="mx-9 mt-5 uppercase text-sm font-bold text-slate-500">
                    <h3>Job Position's Detail</h3>
                    <hr>
                </div>
                <div class="mx-9 mt-2 grid grid-rows-1 grid-flow-col rounded-md">
                    <div class="text-sm font-medium flex items-center mr-6">
                        <InputLabel class="w-32">Department </InputLabel>
                        <select type="text" id="departments" v-model="form.department_id" :disabled="readonly"
                            class="border-0 h-10 w-full hover:border-b-[1px] focus:ring-0 focus:border-slate-500 text-sm font-thin font-s border-b-[1px] border-slate-100">
                            <option value="" disabled selected class="text-sm">Select Department</option>
                            <option v-for="oneDepartment in allDepartments" v-bind:value="oneDepartment.id">
                                {{ oneDepartment.name }}
                            </option>
                        </select>
                    </div>
                    <div class="text-sm font-medium flex items-center ">
                        <InputLabel class="w-24">Summary </InputLabel>
                        <TextInputCustom v-model="form.summary" class="w-full border-b-[1px] border-slate-100"
                            :disabled="readonly" />
                    </div>
                </div>
                <div class="flex justify-end mt-9">
                    <button v-if="!readonly" class="bg-[#7a61ab] text-white px-3 py-2 rounded-lg absolute right-20"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ buttonLabel }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>