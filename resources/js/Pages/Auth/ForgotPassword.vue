<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="flex flex-col items-center">
            <div class="text-6xl">🤔</div>
            <h2 class="mt-4 text-2xl font-extrabold text-yellow-700">Forgot Password?</h2>
            <p class="text-sm text-gray-500 mt-2">No worries! We'll send you reset instructions</p>
        </div>

        <div class="mt-6 text-sm text-gray-600 text-center">
            Enter your email address and we'll send you a password reset link
            to help you regain access to your account.
        </div>

        <div
            v-if="status"
            class="mt-4 p-3 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg text-center"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <InputLabel for="email" value="Email Address" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300 focus:ring-yellow-200"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email address"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-6 flex items-center justify-center">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 rounded-lg py-3 font-semibold"
                >
                    Send Reset Link
                </PrimaryButton>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Remember your password?
                <a href="/login" class="text-yellow-600 hover:text-yellow-700 font-medium">
                    Sign in instead
                </a>
            </p>
        </div>
    </GuestLayout>
</template>
