<template>
  <AuthenticatedLayout>
    <Head title="Create User" />

    <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create New User</h2>
            <p class="text-gray-600 mt-1">Add a new user to the system</p>
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
                  autofocus
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

              <!-- Password -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                  id="password"
                  type="password"
                  v-model="form.password"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input
                  id="password_confirmation"
                  type="password"
                  v-model="form.password_confirmation"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
              </div>

              <!-- Buttons -->
              <div class="flex items-center justify-end gap-4">
                <Link :href="route('admin.users.index')" class="btn-secondary">
                  Cancel
                </Link>
                <button type="submit" class="btn-primary" :disabled="form.processing">
                  Create User
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

const form = useForm({
  name: '',
  email: '',
  role: 'player',
  password: '',
  password_confirmation: '',
});

function submit() {
  form.post(route('admin.users.store'));
}
</script>
