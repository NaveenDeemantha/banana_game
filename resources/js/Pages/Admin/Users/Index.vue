<template>
  <AuthenticatedLayout>
    <Head title="User Management" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-center">
            <div>
              <h2 class="text-3xl font-bold text-gray-800">User Management</h2>
              <p class="text-gray-600 mt-1">Manage all users and their permissions</p>
            </div>
            <Link 
              :href="route('admin.users.create')"
              class="btn-primary"
            >
              + Add User
            </Link>
          </div>
        </div>

        <!-- Filters -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
              <input 
                type="text" 
                v-model="searchForm.search"
                @input="search"
                placeholder="Search by name or email..."
                class="w-full rounded-lg border-gray-300"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
              <select 
                v-model="searchForm.role"
                @change="search"
                class="w-full rounded-lg border-gray-300"
              >
                <option value="all">All Roles</option>
                <option value="admin">Admin</option>
                <option value="player">Player</option>
              </select>
            </div>
            <div class="flex items-end">
              <button 
                @click="clearFilters"
                class="btn-secondary w-full"
              >
                Clear Filters
              </button>
            </div>
          </div>
        </div>

        <!-- Success Message -->
        <div v-if="$page.props.flash?.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
          {{ $page.props.flash.success }}
        </div>

        <!-- Users Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Games</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="text-2xl mr-3">{{ user.role === 'admin' ? '👨‍💼' : '🎮' }}</div>
                    <div class="font-medium text-gray-900">{{ user.name }}</div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ user.email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span 
                    :class="user.role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'"
                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                  >
                    {{ user.role }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ user.game_scores_count }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ formatDate(user.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <Link 
                    :href="route('admin.users.show', user.id)"
                    class="text-blue-600 hover:text-blue-900"
                  >
                    View
                  </Link>
                  <Link 
                    :href="route('admin.users.edit', user.id)"
                    class="text-green-600 hover:text-green-900"
                  >
                    Edit
                  </Link>
                  <button 
                    @click="deleteUser(user)"
                    class="text-red-600 hover:text-red-900"
                    :disabled="user.id === $page.props.auth.user.id"
                    :class="{ 'opacity-50 cursor-not-allowed': user.id === $page.props.auth.user.id }"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" v-if="users.links.length > 3">
          <div class="flex justify-center gap-2">
            <Link
              v-for="link in users.links"
              :key="link.label"
              :href="link.url"
              :class="[
                'px-4 py-2 rounded-lg text-sm',
                link.active ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
                !link.url ? 'opacity-50 cursor-not-allowed' : ''
              ]"
              v-html="link.label"
            />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({
  users: Object,
  filters: Object,
});

const searchForm = reactive({
  search: props.filters?.search || '',
  role: props.filters?.role || 'all',
});

function search() {
  router.get(route('admin.users.index'), searchForm, {
    preserveState: true,
    preserveScroll: true,
  });
}

function clearFilters() {
  searchForm.search = '';
  searchForm.role = 'all';
  search();
}

function deleteUser(user) {
  if (confirm(`Are you sure you want to delete ${user.name}?`)) {
    router.delete(route('admin.users.destroy', user.id), {
      preserveScroll: true,
    });
  }
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString();
}
</script>
