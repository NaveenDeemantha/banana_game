<template>
  <AuthenticatedLayout>
    <Head title="Edit User" />

    <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit User</h2>
            <p class="text-gray-600 mt-1">Update user information</p>
          </div>

          <form @submit.prevent="submit">
            <div class="space-y-6">
              <!-- Name -->
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input
                  id="name"
                  type="text"
                  v-model="form.name"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                  id="email"
                  type="email"
                  v-model="form.email"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
              </div>

              <!-- Role -->
              <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select
                  id="role"
                  v-model="form.role"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                >
                  <option value="player">Player</option>
                  <option value="admin">Admin</option>
                </select>
                <p v-if="form.errors.role" class="mt-1 text-sm text-red-600">{{ form.errors.role }}</p>
              </div>

              <!-- Password (Optional) -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                  New Password <span class="text-gray-500 text-xs">(leave blank to keep current)</span>
                </label>
                <input
                  id="password"
                  type="password"
                  v-model="form.password"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                />
                <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
              </div>

              <!-- Confirm Password -->
              <div v-if="form.password">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input
                  id="password_confirmation"
                  type="password"
                  v-model="form.password_confirmation"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                />
              </div>

              <!-- Buttons -->
              <div class="flex items-center justify-end gap-4">
                <Link :href="route('admin.users.index')" class="btn-secondary">
                  Cancel
                </Link>
                <button type="submit" class="btn-primary" :disabled="form.processing">
                  Update User
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
});

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.role,
  password: '',
  password_confirmation: '',
});

function submit() {
  form.put(route('admin.users.update', props.user.id));
}
</script>
