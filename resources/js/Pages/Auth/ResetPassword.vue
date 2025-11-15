<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <div class="flex flex-col items-center">
            <div class="text-6xl">🔑</div>
            <h2 class="mt-4 text-2xl font-extrabold text-yellow-700">Reset Password</h2>
            <p class="text-sm text-gray-500 mt-2">Enter your new password to secure your account</p>
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300 focus:ring-yellow-200"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    readonly
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="New Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300 focus:ring-yellow-200"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm New Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300 focus:ring-yellow-200"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-6 flex items-center justify-center">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 rounded-lg py-3 font-semibold"
                >
                    Reset Password
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
