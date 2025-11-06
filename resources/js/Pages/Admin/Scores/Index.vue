<template>
  <AuthenticatedLayout>
    <Head title="Score Management" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-center">
            <div>
              <h2 class="text-3xl font-bold text-gray-800">Score Management</h2>
              <p class="text-gray-600 mt-1">Manage all game scores</p>
            </div>
            <div class="text-5xl">🏆</div>
          </div>
        </div>

        <!-- Filters -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Search Player</label>
              <input 
                type="text" 
                v-model="searchForm.search"
                @input="search"
                placeholder="Search by name or email..."
                class="w-full rounded-lg border-gray-300"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty</label>
              <select 
                v-model="searchForm.difficulty"
                @change="search"
                class="w-full rounded-lg border-gray-300"
              >
                <option value="all">All Difficulties</option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
              <select 
                v-model="searchForm.sort"
                @change="search"
                class="w-full rounded-lg border-gray-300"
              >
                <option value="created_at">Date</option>
                <option value="score">Score</option>
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

        <!-- Scores Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Player</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Accuracy</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="score in scores.data" :key="score.id" class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="text-2xl mr-3">🎮</div>
                      <div>
                        <div class="font-medium text-gray-900">{{ score.user?.name || 'Unknown' }}</div>
                        <div class="text-sm text-gray-500">{{ score.user?.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      :class="getDifficultyClass(score.difficulty)"
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                    >
                      {{ score.difficulty }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-lg font-bold text-gray-900">{{ score.score }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ score.correct_answers }}/{{ score.total_questions }}
                    <span class="text-gray-400">
                      ({{ Math.round((score.correct_answers / score.total_questions) * 100) }}%)
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ score.time_taken }}s
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ formatDate(score.created_at) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <Link 
                      :href="route('admin.scores.show', score.id)"
                      class="text-blue-600 hover:text-blue-900"
                    >
                      View
                    </Link>
                    <Link 
                      :href="route('admin.scores.edit', score.id)"
                      class="text-green-600 hover:text-green-900"
                    >
                      Edit
                    </Link>
                    <button 
                      @click="deleteScore(score)"
                      class="text-red-600 hover:text-red-900"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" v-if="scores.links.length > 3">
          <div class="flex justify-center gap-2">
            <Link
              v-for="link in scores.links"
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
  scores: Object,
  filters: Object,
});

const searchForm = reactive({
  search: props.filters?.search || '',
  difficulty: props.filters?.difficulty || 'all',
  sort: props.filters?.sort || 'created_at',
  order: props.filters?.order || 'desc',
});

function search() {
  router.get(route('admin.scores.index'), searchForm, {
    preserveState: true,
    preserveScroll: true,
  });
}

function clearFilters() {
  searchForm.search = '';
  searchForm.difficulty = 'all';
  searchForm.sort = 'created_at';
  searchForm.order = 'desc';
  search();
}

function deleteScore(score) {
  if (confirm('Are you sure you want to delete this score?')) {
    router.delete(route('admin.scores.destroy', score.id), {
      preserveScroll: true,
    });
  }
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString();
}

function getDifficultyClass(difficulty) {
  const classes = {
    easy: 'bg-green-100 text-green-800',
    medium: 'bg-yellow-100 text-yellow-800',
    hard: 'bg-red-100 text-red-800',
  };
  return classes[difficulty] || 'bg-gray-100 text-gray-800';
}
</script>
