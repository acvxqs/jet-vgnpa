<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div v-html="dashboard" class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                </div>
            </div>
        </div>
    </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    
    export default defineComponent({
        components: {
            AppLayout,
            JetAuthenticationCardLogo,
        },
        props: ['dashboard'],
    })
</script>
