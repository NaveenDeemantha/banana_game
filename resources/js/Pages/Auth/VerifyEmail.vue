<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="flex flex-col items-center">
            <div class="text-6xl">📧</div>
            <h2 class="mt-4 text-2xl font-extrabold text-yellow-700">Verify Your Email</h2>
            <p class="text-sm text-gray-500 mt-2">Check your inbox and click the verification link</p>
        </div>

        <div class="mt-6 text-sm text-gray-600 text-center">
            To complete your registration and access all features, please verify your email address
            by clicking the verification link we sent to your inbox.
        </div>

        <div
            class="mt-4 p-3 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg text-center"
            v-if="verificationLinkSent"
        >
            A new verification link has been sent to your email address.
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div class="flex flex-col space-y-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900"
                >
                    Resend Verification Email
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full text-center py-2 px-4 rounded-lg text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 hover:text-gray-800 transition-colors duration-200"
                >
                    Log Out
                </Link>
            </div>
        </form>

        <div class="mt-6 text-xs text-gray-500 text-center">
            <p>Didn't receive the email? Check your spam folder or contact support.</p>
        </div>
    </GuestLayout>
</template>
