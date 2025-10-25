<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="flex flex-col items-center">
            <div class="text-6xl">🍌</div>
            <h2 class="mt-4 text-2xl font-extrabold text-yellow-700">Banana Catcher</h2>
            <p class="text-sm text-gray-500 mt-2">Sign in to continue catching bananas</p>
        </div>

        <div v-if="status" class="mb-4 mt-4 text-sm font-medium text-green-600">{{ status }}</div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-yellow-200 focus:border-yellow-300"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex items-center justify-between">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>

                <div>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-yellow-700 underline hover:text-yellow-800"
                    >
                        Forgot?
                    </Link>
                </div>
            </div>

            <div class="mt-6">
                <PrimaryButton
                    class="w-full bg-yellow-500 text-black hover:bg-yellow-600"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>

            <div class="mt-4 text-center text-sm">
                <span class="text-gray-600">Don't have an account?</span>
                <Link :href="route('register')" class="text-yellow-700 underline ms-2">Register</Link>
            </div>
        </form>
    </GuestLayout>
</template>
