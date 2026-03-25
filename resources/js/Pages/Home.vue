<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const user = usePage().props.auth.user
if (user) {
    window.location.href = "/dashboard"
}
</script>

<template>
    <GuestLayout>
        <Head title="Home" />

        <div class="bg-white p-6 rounded-lg shadow-md">

            <div class="flex flex-col gap-4 items-center">

                <Link href="/login" class="w-full">
                    <PrimaryButton class="w-full justify-center">
                        Log In
                    </PrimaryButton>
                </Link>

                <Link href="/register" class="w-full">
                    <PrimaryButton class="w-full justify-center">
                        Register
                    </PrimaryButton>
                </Link>

            </div>

        </div>

        <div class="text-center mt-6 text-gray-500">
            created by botaro
        </div>

    </GuestLayout>
</template>