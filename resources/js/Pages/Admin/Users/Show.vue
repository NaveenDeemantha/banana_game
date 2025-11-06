<template>
  <AuthenticatedLayout>
    <Head :title="`User: ${user.name}`" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- User Info Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-start">
            <div class="flex items-center gap-4">
              <div class="text-6xl">{{ user.role === 'admin' ? '👨‍💼' : '🎮' }}</div>
              <div>
                <h2 class="text-3xl font-bold text-gray-800">{{ user.name }}</h2>
                <p class="text-gray-600">{{ user.email }}</p>
                <span 
                  :class="user.role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'"
                  class="mt-2 inline-block px-3 py-1 text-xs font-semibold rounded-full"
                >
                  {{ user.role }}
                </span>
              </div>
            </div>
            <div class="flex gap-2">
              <Link :href="route('admin.users.edit', user.id)" class="btn-primary">
                Edit User
              </Link>
              <Link :href="route('admin.users.index')" class="btn-secondary">
                Back to List
              </Link>
            </div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <p class="text-blue-100 text-sm">Total Games</p>
            <p class="text-3xl font-bold mt-2">{{ stats.total_games }}</p>
          </div>
          <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <p class="text-green-100 text-sm">Best Score</p>
            <p class="text-3xl font-bold mt-2">{{ stats.best_score || 0 }}</p>
          </div>
          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <p class="text-purple-100 text-sm">Average Score</p>
            <p class="text-3xl font-bold mt-2">{{ stats.average_score || 0 }}</p>
          </div>
          <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
            <p class="text-orange-100 text-sm">Total Points</p>
            <p class="text-3xl font-bold mt-2">{{ stats.total_score || 0 }}</p>
          </div>
        </div>

        <!-- Best Scores by Difficulty -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Best Scores by Difficulty</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-green-50 rounded-lg">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-600">Easy</p>
                  <p class="text-2xl font-bold text-gray-800">{{ stats.best_easy || 0 }}</p>
                </div>
                <div class="text-3xl">🌟</div>
              </div>
            </div>
            <div class="p-4 bg-yellow-50 rounded-lg">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-600">Medium</p>
                  <p class="text-2xl font-bold text-gray-800">{{ stats.best_medium || 0 }}</p>
                </div>
                <div class="text-3xl">⚡</div>
              </div>
            </div>
            <div class="p-4 bg-red-50 rounded-lg">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-600">Hard</p>
                  <p class="text-2xl font-bold text-gray-800">{{ stats.best_hard || 0 }}</p>
                </div>
                <div class="text-3xl">🔥</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Games -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Games</h3>
          <div v-if="user.game_scores && user.game_scores.length > 0" class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Accuracy</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="game in user.game_scores" :key="game.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ formatDate(game.created_at) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span 
                      :class="getDifficultyClass(game.difficulty)"
                      class="px-2 py-1 text-xs font-semibold rounded-full"
                    >
                      {{ game.difficulty }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                    {{ game.score }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ game.correct_answers }}/{{ game.total_questions }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ game.time_taken }}s
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="text-center py-8 text-gray-500">
            No games played yet
          </div>
        </div>

        <!-- User Details -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">User Details</h3>
          <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <dt class="text-sm font-medium text-gray-500">User ID</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ user.id }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Member Since</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ formatDate(user.created_at) }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ formatDate(user.updated_at) }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
              <dd class="mt-1 text-sm text-gray-900">
                {{ user.email_verified_at ? 'Yes' : 'No' }}
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  user: Object,
  stats: Object,
});

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
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
