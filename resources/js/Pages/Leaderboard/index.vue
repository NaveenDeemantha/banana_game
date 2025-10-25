<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center p-8 relative overflow-hidden">
    <!-- Floating corner bananas -->
    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>

    <div class="banana-card w-full max-w-2xl">
      <div class="text-center mb-8">
        <div class="text-6xl mb-4 animate-float-y">🏆</div>
        <h2 class="text-4xl font-extrabold text-yellow-800 mb-2">Leaderboard</h2>
        <p class="text-yellow-700/80">Top banana catchers of all time!</p>
      </div>

      <div class="space-y-4">
        <div v-for="(player, i) in players" :key="i" 
             class="flex items-center justify-between p-4 bg-white/80 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-[1.02]"
             :class="i === 0 ? 'ring-2 ring-yellow-400 bg-gradient-to-r from-yellow-50 to-yellow-100' : ''"
        >
          <div class="flex items-center gap-4">
            <div class="flex items-center justify-center w-12 h-12 rounded-full font-bold text-white text-lg"
                 :class="i === 0 ? 'bg-yellow-500' : i === 1 ? 'bg-gray-400' : i === 2 ? 'bg-orange-400' : 'bg-blue-400'"
            >
              {{ i + 1 }}
            </div>
            <div class="text-4xl">{{ player.avatar }}</div>
            <div>
              <div class="font-bold text-gray-800 text-lg">{{ player.name }}</div>
              <div class="text-sm text-gray-600">{{ player.level }} Player</div>
            </div>
          </div>
          <div class="text-right">
            <div class="font-bold text-yellow-700 text-xl">{{ player.score }}</div>
            <div class="text-sm text-yellow-600">🍌 bananas</div>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center space-y-4">
        <div class="bg-yellow-100/50 rounded-lg p-4">
          <div class="text-2xl mb-2">🎯</div>
          <div class="text-sm font-medium text-yellow-800">Your best score: 42 🍌</div>
          <div class="text-xs text-yellow-700">Rank #12 globally</div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link href="/play" class="px-6 py-3 bg-yellow-500 text-white rounded-xl shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold">
            🎮 Play Again
          </Link>
          <Link href="/home" class="px-6 py-3 bg-white text-yellow-700 border-2 border-yellow-400 rounded-xl shadow-lg hover:bg-yellow-50 transition-all duration-300 transform hover:scale-105 font-semibold">
            🏠 Back to Home
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const players = [
  { name: "Alex", score: 120, avatar: "🦸‍♂️", level: "Expert" },
  { name: "Naveen", score: 110, avatar: "🧠", level: "Pro" },
  { name: "Maya", score: 95, avatar: "⭐", level: "Advanced" },
  { name: "Sam", score: 85, avatar: "🎯", level: "Intermediate" },
  { name: "Emma", score: 75, avatar: "🚀", level: "Beginner" }
];
</script>
