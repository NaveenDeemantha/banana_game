<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="flex flex-col items-center">
            <div class="text-6xl">🛡️</div>
            <h2 class="mt-4 text-2xl font-extrabold text-yellow-700">Confirm Password</h2>
            <p class="text-sm text-gray-500 mt-2">Please verify your password to continue</p>
        </div>

        <div class="mt-6 text-sm text-gray-600 text-center">
            This is a secure area of the application. Please confirm your
            password before continuing to protect your account.
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300 focus:ring-yellow-200"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                    placeholder="Enter your password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-6 flex justify-center">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 rounded-lg py-3 font-semibold"
                >
                    Confirm Password
                </PrimaryButton>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Having trouble?
                <a href="/forgot-password" class="text-yellow-600 hover:text-yellow-700 font-medium">
                    Reset your password
                </a>
            </p>
        </div>
    </GuestLayout>
</template>
