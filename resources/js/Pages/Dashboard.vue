<script setup>
import BreezeAuthenticatedLayout from '@/layouts/Authenticated.vue'
import Link from '@/Components/Link.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3'
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1>Dashboard</h1>
                        You are logged in !
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

