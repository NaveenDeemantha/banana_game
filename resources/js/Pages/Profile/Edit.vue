<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                    class="text-xl font-semibold leading-tight text-yellow-700"
                >
                    Profile
                </h2>
        </template>

        <div class="py-12 bg-animated-yellow relative overflow-hidden">
            <!-- Floating corner bananas -->
            <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
            <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>
            
            <div class="mx-auto max-w-4xl space-y-8 sm:px-6 lg:px-8">
                <!-- Profile Header -->
                <div class="text-center mb-8">
                    <div class="text-6xl mb-4 animate-float-y">👤</div>
                    <h1 class="text-3xl font-bold text-yellow-800 mb-2">Profile Settings</h1>
                    <p class="text-yellow-700">Manage your account information and preferences</p>
                </div>

                <!-- Profile Information Card -->
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📝</span>
                            <h3 class="text-xl font-bold text-yellow-700">Account Information</h3>
                        </div>
                        <span class="profile-badge">Primary</span>
                    </div>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-none"
                    />
                </div>

                <!-- Password Security Card -->
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🔒</span>
                            <h3 class="text-xl font-bold text-yellow-700">Security Settings</h3>
                        </div>
                        <span class="profile-badge bg-blue-100 text-blue-700">Security</span>
                    </div>
                    <UpdatePasswordForm class="max-w-none" />
                </div>

                <!-- Danger Zone Card -->
                <div class="profile-card border-red-200">
                    <div class="profile-card-header">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">⚠️</span>
                            <h3 class="text-xl font-bold text-red-600">Danger Zone</h3>
                        </div>
                        <span class="profile-badge bg-red-100 text-red-700">Caution</span>
                    </div>
                    <DeleteUserForm class="max-w-none" />
                </div>

                <!-- Navigation Footer -->
                <div class="text-center mt-8">
                    <a href="/home" class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-500 text-white rounded-xl shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold">
                        <span>🏠</span>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.profile-card {
  @apply bg-white/95 backdrop-blur-sm border border-yellow-200 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl;
}

.profile-card-header {
  @apply flex items-center justify-between p-6 bg-gradient-to-r from-yellow-50 to-yellow-100/50 border-b border-yellow-200;
}

.profile-badge {
  @apply px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full;
}
</style>
