<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

// check user
const user = usePage().props.auth.user

if (user) {
    window.location.href = "/dashboard"
}
</script>

<template>
    <Head title="Home" />

    <div class="min-h-screen flex flex-col justify-between bg-gray-100">

        <!-- Center -->
        <div class="flex flex-col items-center justify-center flex-grow">

            <img 
                src="/logo.png"
                alt="braindump"
                class="w- mb-4"
            />

            <h1 class="text-5xl font-bold text-gray-700 mb-8">
                Brain Dump
            </h1>

            <div class="flex gap-6">
                <Link href="/login">
                    <PrimaryButton>
                        Login
                    </PrimaryButton>
                </Link>

                <Link href="/register">
                    <PrimaryButton>
                        Register
                    </PrimaryButton>
                </Link>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mb-6 text-gray-500">
            created by botarokubo
        </div>

    </div>
</template>