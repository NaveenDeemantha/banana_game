<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center p-8 relative overflow-hidden">
    <!-- User Menu in Top Right -->
    <div class="absolute top-6 right-6 z-10">
      <Link 
        v-if="$page.props.auth?.user"
        :href="route('logout')" 
        method="post" 
        as="button"
        class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 transition-all duration-300 transform hover:scale-105 font-medium text-sm"
      >
        🚪 Logout
      </Link>
      <div v-else class="flex items-center gap-3">
        <Link 
          href="/login" 
          class="px-4 py-2 bg-white text-yellow-700 border-2 border-yellow-400 rounded-lg shadow-lg hover:bg-yellow-50 transition-all duration-300 transform hover:scale-105 font-medium text-sm"
        >
          🔑 Login
        </Link>
        <Link 
          href="/register" 
          class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-medium text-sm"
        >
          ✨ Register
        </Link>
      </div>
    </div>

    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>

    <div class="banana-card w-full max-w-2xl">
      <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-float-y">🏆</div>
        <h2 class="text-4xl font-extrabold text-yellow-800 mb-2">Leaderboard</h2>
        <p class="text-yellow-700/80">Top banana catchers of all time!</p>
      </div>

      <!-- Difficulty Filter -->
      <div class="mb-6 flex gap-2 justify-center flex-wrap">
        <button 
          v-for="diff in difficulties" 
          :key="diff.value"
          @click="selectedDifficulty = diff.value; fetchLeaderboard()"
          class="px-4 py-2 rounded-lg font-medium transition-all duration-300"
          :class="selectedDifficulty === diff.value 
            ? 'bg-yellow-500 text-white shadow-lg' 
            : 'bg-white text-yellow-700 hover:bg-yellow-100'"
        >
          {{ diff.icon }} {{ diff.label }}
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="text-center py-12">
        <div class="text-6xl animate-spin mb-4">🍌</div>
        <p class="text-yellow-700">Loading leaderboard...</p>
      </div>

      <!-- Leaderboard List -->
      <div v-else-if="players.length > 0" class="space-y-4">
        <div v-for="(player, i) in players" :key="i" 
             class="flex items-center justify-between p-4 bg-white/80 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-[1.02]"
             :class="[
               i === 0 ? 'ring-2 ring-yellow-400 bg-gradient-to-r from-yellow-50 to-yellow-100' : '',
               isCurrentUser(player.user_id) ? 'ring-2 ring-blue-400 bg-blue-50' : ''
             ]"
        >
          <div class="flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-white text-lg"
                 :class="getRankClass(i)"
            >
              {{ i + 1 }}
            </div>
            <div class="text-4xl">{{ getAvatar(i) }}</div>
            <div>
              <div class="font-bold text-gray-800 text-lg flex items-center gap-2">
                {{ player.name }}
                <span v-if="isCurrentUser(player.user_id)" class="text-xs bg-blue-500 text-white px-2 py-1 rounded-full">You</span>
              </div>
              <div class="text-sm text-gray-600">
                {{ player.correct_answers || 0 }} correct answers
              </div>
            </div>
          </div>
          <div class="text-right">
            <div class="font-bold text-yellow-700 text-xl">{{ player.score }}</div>
            <div class="text-sm text-yellow-600">🍌 points</div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <div class="text-6xl mb-4">🎮</div>
        <p class="text-yellow-700 mb-4">No scores yet for this difficulty!</p>
        <p class="text-yellow-600 text-sm">Be the first to play and set a record!</p>
      </div>

      <!-- User's Stats (if authenticated) -->
      <div v-if="userStats && $page.props.auth?.user" class="mt-8 bg-yellow-100/50 rounded-lg p-4">
        <div class="text-2xl mb-2">🎯</div>
        <div class="grid grid-cols-3 gap-4 text-center">
          <div>
            <div class="text-sm font-medium text-yellow-800">Your Best</div>
            <div class="text-xl font-bold text-yellow-700">{{ userStats.best_score || 0 }}</div>
          </div>
          <div>
            <div class="text-sm font-medium text-yellow-800">Games Played</div>
            <div class="text-xl font-bold text-yellow-700">{{ userStats.total_games || 0 }}</div>
          </div>
          <div>
            <div class="text-sm font-medium text-yellow-800">Avg Score</div>
            <div class="text-xl font-bold text-yellow-700">{{ userStats.average_score || 0 }}</div>
          </div>
        </div>
      </div>

      <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
        <Link href="/play" class="px-6 py-3 bg-yellow-500 text-white rounded-xl shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold text-center">
          🎮 Play Again
        </Link>
        <Link href="/home" class="px-6 py-3 bg-white text-yellow-700 border-2 border-yellow-400 rounded-xl shadow-lg hover:bg-yellow-50 transition-all duration-300 transform hover:scale-105 font-semibold text-center">
          🏠 Back to Home
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const page = usePage();
const players = ref([]);
const userStats = ref(null);
const loading = ref(true);
const selectedDifficulty = ref(null);

const difficulties = [
  { value: null, label: 'All', icon: '🌟' },
  { value: 'easy', label: 'Easy', icon: '🥥' },
  { value: 'medium', label: 'Medium', icon: '🍍' },
  { value: 'hard', label: 'Hard', icon: '🌶️' }
];

const avatars = ['🦸‍♂️', '🧠', '⭐', '🎯', '🚀', '💎', '🔥', '⚡', '🌟', '🎨'];

function getAvatar(index) {
  return avatars[index % avatars.length];
}

function getRankClass(index) {
  if (index === 0) return 'bg-yellow-500';
  if (index === 1) return 'bg-gray-400';
  if (index === 2) return 'bg-orange-400';
  return 'bg-blue-400';
}

function isCurrentUser(userId) {
  return page.props.auth?.user?.id === userId;
}

async function fetchLeaderboard() {
  loading.value = true;
  try {
    const params = new URLSearchParams();
    if (selectedDifficulty.value) {
      params.append('difficulty', selectedDifficulty.value);
    }
    params.append('limit', '10');
    
    const response = await fetch(`/api/leaderboard?${params.toString()}`);
    const data = await response.json();
    
    if (data.success) {
      players.value = data.data;
    }
  } catch (error) {
    console.error('Failed to fetch leaderboard:', error);
  } finally {
    loading.value = false;
  }
}

async function fetchUserStats() {
  if (!page.props.auth?.user) return;
  
  try {
    const response = await fetch('/api/scores/history', {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    });
    const data = await response.json();
    
    if (data.success) {
      userStats.value = data.stats;
    }
  } catch (error) {
    console.error('Failed to fetch user stats:', error);
  }
}

onMounted(() => {
  fetchLeaderboard();
  fetchUserStats();
});
</script>
