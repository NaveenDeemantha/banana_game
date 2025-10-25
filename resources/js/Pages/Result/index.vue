<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const gameResults = ref({
  score: 85,
  totalQuestions: 15,
  correctAnswers: 12,
  difficulty: 'Medium',
  timeBonus: 25,
  accuracy: 80,
  newRecord: false
});

const showAnimation = ref(false);

onMounted(() => {
  setTimeout(() => {
    showAnimation.value = true;
  }, 300);
});

function getScoreColor(score) {
  if (score >= 90) return 'text-green-600';
  if (score >= 70) return 'text-yellow-600';
  return 'text-orange-600';
}

function getPerformanceMessage(score) {
  if (score >= 90) return 'Outstanding! 🌟';
  if (score >= 70) return 'Great Job! 🎉';
  if (score >= 50) return 'Good Effort! 👏';
  return 'Keep Practicing! 💪';
}
</script>

<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden">
    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>

    <div class="banana-card w-full max-w-2xl mx-4">
      <div class="text-center mb-8">
        <div class="text-8xl mb-4 animate-float-y">🎉</div>
        <h2 class="text-4xl font-extrabold text-yellow-700 mb-2">{{ getPerformanceMessage(gameResults.score) }}</h2>
        <p class="text-yellow-600">Your banana catching session is complete!</p>
      </div>

      <!-- Score Display -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-white shadow-lg mb-4" :class="showAnimation ? 'animate-bounce' : ''">
          <div class="text-4xl font-bold" :class="getScoreColor(gameResults.score)">
            {{ gameResults.score }}
          </div>
        </div>
        <div class="text-lg text-yellow-700 font-semibold">Final Score</div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white/70 rounded-xl p-4 text-center">
          <div class="text-2xl font-bold text-blue-600">{{ gameResults.correctAnswers }}</div>
          <div class="text-sm text-gray-600">Correct</div>
        </div>
        <div class="bg-white/70 rounded-xl p-4 text-center">
          <div class="text-2xl font-bold text-purple-600">{{ gameResults.totalQuestions }}</div>
          <div class="text-sm text-gray-600">Total</div>
        </div>
        <div class="bg-white/70 rounded-xl p-4 text-center">
          <div class="text-2xl font-bold text-green-600">{{ gameResults.accuracy }}%</div>
          <div class="text-sm text-gray-600">Accuracy</div>
        </div>
        <div class="bg-white/70 rounded-xl p-4 text-center">
          <div class="text-2xl font-bold text-orange-600">+{{ gameResults.timeBonus }}</div>
          <div class="text-sm text-gray-600">Time Bonus</div>
        </div>
      </div>

      <!-- Achievement Badges -->
      <div class="mb-8">
        <h3 class="text-lg font-semibold text-yellow-700 mb-4 text-center">Achievements Unlocked</h3>
        <div class="flex flex-wrap justify-center gap-4">
          <div v-if="gameResults.correctAnswers >= 10" class="bg-yellow-100 rounded-lg p-3 text-center">
            <div class="text-2xl mb-1">🏅</div>
            <div class="text-xs font-medium text-yellow-800">Speed Demon</div>
          </div>
          <div v-if="gameResults.accuracy >= 80" class="bg-green-100 rounded-lg p-3 text-center">
            <div class="text-2xl mb-1">🎯</div>
            <div class="text-xs font-medium text-green-800">Sharp Shooter</div>
          </div>
          <div v-if="gameResults.score >= 80" class="bg-blue-100 rounded-lg p-3 text-center">
            <div class="text-2xl mb-1">⭐</div>
            <div class="text-xs font-medium text-blue-800">High Scorer</div>
          </div>
        </div>
      </div>

      <!-- Record Notice -->
      <div v-if="gameResults.newRecord" class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-xl p-4 mb-8 text-center text-white">
        <div class="text-3xl mb-2">🏆</div>
        <div class="font-bold">New Personal Record!</div>
        <div class="text-sm">You've beaten your previous best score!</div>
      </div>

      <!-- Action Buttons -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <Link href="/play" class="action-btn bg-yellow-500 hover:bg-yellow-600 text-white">
          <span class="text-xl mr-2">🔁</span>
          Play Again
        </Link>
        <Link href="/leaderboard" class="action-btn bg-green-500 hover:bg-green-600 text-white">
          <span class="text-xl mr-2">🏆</span>
          Leaderboard
        </Link>
        <Link href="/home" class="action-btn bg-blue-500 hover:bg-blue-600 text-white">
          <span class="text-xl mr-2">🏠</span>
          Home
        </Link>
      </div>

      <!-- Share Section -->
      <div class="mt-8 text-center">
        <div class="text-sm text-yellow-700 mb-3">Share your achievement!</div>
        <div class="flex justify-center gap-4">
          <button class="w-10 h-10 bg-blue-500 rounded-full text-white hover:scale-110 transition-transform">📱</button>
          <button class="w-10 h-10 bg-green-500 rounded-full text-white hover:scale-110 transition-transform">💬</button>
          <button class="w-10 h-10 bg-purple-500 rounded-full text-white hover:scale-110 transition-transform">📧</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.action-btn {
  @apply px-6 py-3 text-center font-semibold rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl;
}
</style>
