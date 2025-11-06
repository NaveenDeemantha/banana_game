<template>
  <AuthenticatedLayout>
    <Head title="Admin Dashboard" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-center">
            <div>
              <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
              <p class="text-gray-600 mt-1">Manage your Banana Catcher game</p>
            </div>
            <div class="text-5xl">👨‍💼</div>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-blue-100 text-sm">Total Users</p>
                <p class="text-3xl font-bold mt-2">{{ stats.total_users }}</p>
                <p class="text-blue-100 text-xs mt-2">
                  +{{ stats.new_users_today }} today
                </p>
              </div>
              <div class="text-4xl opacity-50">👥</div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-green-100 text-sm">Total Games</p>
                <p class="text-3xl font-bold mt-2">{{ stats.total_games }}</p>
                <p class="text-green-100 text-xs mt-2">
                  +{{ stats.games_today }} today
                </p>
              </div>
              <div class="text-4xl opacity-50">🎮</div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-purple-100 text-sm">Average Score</p>
                <p class="text-3xl font-bold mt-2">{{ stats.average_score }}</p>
                <p class="text-purple-100 text-xs mt-2">
                  All time
                </p>
              </div>
              <div class="text-4xl opacity-50">📊</div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
              <div>
                <p class="text-orange-100 text-sm">Players</p>
                <p class="text-3xl font-bold mt-2">{{ stats.total_players }}</p>
                <p class="text-orange-100 text-xs mt-2">
                  {{ stats.total_admins }} admins
                </p>
              </div>
              <div class="text-4xl opacity-50">🎯</div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Link 
              :href="route('admin.users.index')"
              class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition"
            >
              <div class="text-3xl">👥</div>
              <div>
                <p class="font-semibold text-gray-800">Manage Users</p>
                <p class="text-sm text-gray-600">View and edit users</p>
              </div>
            </Link>

            <Link 
              :href="route('admin.scores.index')"
              class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition"
            >
              <div class="text-3xl">🏆</div>
              <div>
                <p class="font-semibold text-gray-800">Manage Scores</p>
                <p class="text-sm text-gray-600">View and edit scores</p>
              </div>
            </Link>

            <Link 
              :href="route('admin.users.create')"
              class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition"
            >
              <div class="text-3xl">➕</div>
              <div>
                <p class="font-semibold text-gray-800">Add User</p>
                <p class="text-sm text-gray-600">Create new user</p>
              </div>
            </Link>
          </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Recent Games -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Games</h3>
            <div class="space-y-3 max-h-96 overflow-y-auto">
              <div 
                v-for="game in recent_games" 
                :key="game.id"
                class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
              >
                <div class="flex-1">
                  <p class="font-semibold text-gray-800">{{ game.user?.name || 'Unknown' }}</p>
                  <p class="text-sm text-gray-600">
                    {{ game.difficulty }} - {{ game.score }} points
                  </p>
                  <p class="text-xs text-gray-500">
                    {{ formatDate(game.created_at) }}
                  </p>
                </div>
                <div class="text-2xl">
                  {{ game.difficulty === 'hard' ? '🔥' : game.difficulty === 'medium' ? '⚡' : '🌟' }}
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Users -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Users</h3>
            <div class="space-y-3 max-h-96 overflow-y-auto">
              <div 
                v-for="user in recent_users" 
                :key="user.id"
                class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
              >
                <div class="flex-1">
                  <p class="font-semibold text-gray-800">{{ user.name }}</p>
                  <p class="text-sm text-gray-600">{{ user.email }}</p>
                  <p class="text-xs text-gray-500">
                    {{ formatDate(user.created_at) }}
                  </p>
                </div>
                <span 
                  :class="user.role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'"
                  class="px-2 py-1 rounded text-xs font-semibold"
                >
                  {{ user.role }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Players -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Top Players</h3>
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div 
              v-for="(player, index) in top_players" 
              :key="player.id"
              class="text-center p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg"
            >
              <div class="text-4xl mb-2">
                {{ index === 0 ? '🥇' : index === 1 ? '🥈' : index === 2 ? '🥉' : '🏅' }}
              </div>
              <p class="font-bold text-gray-800">{{ player.name }}</p>
              <p class="text-sm text-gray-600">{{ player.game_scores_count }} games</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  stats: Object,
  recent_games: Array,
  recent_users: Array,
  top_players: Array,
});

function formatDate(dateString) {
  const date = new Date(dateString);
  const now = new Date();
  const diffMs = now - date;
  const diffMins = Math.floor(diffMs / 60000);
  const diffHours = Math.floor(diffMs / 3600000);
  const diffDays = Math.floor(diffMs / 86400000);

  if (diffMins < 1) return 'Just now';
  if (diffMins < 60) return `${diffMins}m ago`;
  if (diffHours < 24) return `${diffHours}h ago`;
  if (diffDays < 7) return `${diffDays}d ago`;
  
  return date.toLocaleDateString();
}
</script>
