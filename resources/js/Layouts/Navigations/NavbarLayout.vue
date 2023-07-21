<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <div class="min-h-screen bg-gray-100">
            <div class="w-screen h-10 bg-[#7a61ab] align-middle flex items-center">

                <div class="align-middle flex items-center">
                    <!-- Logo -->
                    <div class="h-10 flex items-center hover:bg-[#614a8c] hover:text-white">
                        <Dropdown class="">
                            <template #trigger>
                                <button type="button" class="flex mr-[3px]">
                                    <ApplicationMark class="block h-[18px] w-auto" />
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('employees.index')">
                                    Employees
                                </DropdownLink>
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Log Out
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                    <NavLink :href="route('employees.index')" :active="route().current('employees.index')"
                        class="text-white text-[18px] mr-4 h-10 hover:bg-[#614a8c] hover:text-white text-center align-middle">
                        Employees
                    </NavLink>
                    <div class="">
                        <NavLink :href="route('employees.index')" :active="route().current('employees.index')"
                            class="text-white mr-4 h-10 hover:bg-[#614a8c] hover:text-white">
                            Employees
                        </NavLink>
                        <NavLink :href="route('departments.index')" :active="route().current('department.index')"
                            class="text-white mr-4 h-10 hover:bg-[#614a8c] hover:text-white">
                            Departments
                        </NavLink>
                        <NavLink :href="route('positions.index')" :active="route().current('position.index')"
                            class="text-white mr-4 h-10 hover:bg-[#614a8c] hover:text-white">
                            Job Position
                        </NavLink>
                    </div>
                </div>

            </div>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow-inherit border-b-2 ">
                <div class="mx-auto py-2 px-4">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
