<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center text-center relative overflow-hidden">
    <!-- Floating corner bananas -->
    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>

    <div class="banana-card max-w-4xl mx-4">
      <div class="text-6xl mb-6 animate-float-y">🎯</div>
      <h2 class="text-5xl font-bold text-yellow-800 mb-8">Choose Your Challenge</h2>
      <p class="text-lg text-yellow-700/80 mb-10">Select difficulty level to start your banana catching adventure!</p>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Easy Level -->
        <Link href="/play?level=easy" class="difficulty-card bg-gradient-to-br from-green-400 to-green-500 hover:from-green-500 hover:to-green-600">
          <div class="text-6xl mb-4">🥥</div>
          <h3 class="text-2xl font-bold text-white mb-2">Easy</h3>
          <div class="text-green-100 mb-4">
            <div class="text-sm">⏱️ 12 seconds per question</div>
            <div class="text-sm">🍌 Perfect for beginners</div>
          </div>
          <div class="mt-auto">
            <span class="text-white text-lg font-semibold">Start Easy Mode</span>
          </div>
        </Link>

        <!-- Medium Level -->
        <Link href="/play?level=medium" class="difficulty-card bg-gradient-to-br from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600">
          <div class="text-6xl mb-4">🍍</div>
          <h3 class="text-2xl font-bold text-white mb-2">Medium</h3>
          <div class="text-yellow-100 mb-4">
            <div class="text-sm">⏱️ 8 seconds per question</div>
            <div class="text-sm">� Moderate challenge</div>
          </div>
          <div class="mt-auto">
            <span class="text-white text-lg font-semibold">Start Medium Mode</span>
          </div>
        </Link>

        <!-- Hard Level -->
        <Link href="/play?level=hard" class="difficulty-card bg-gradient-to-br from-red-400 to-red-500 hover:from-red-500 hover:to-red-600">
          <div class="text-6xl mb-4">🌶️</div>
          <h3 class="text-2xl font-bold text-white mb-2">Hard</h3>
          <div class="text-red-100 mb-4">
            <div class="text-sm">⏱️ 5 seconds per question</div>
            <div class="text-sm">🍌 Expert level</div>
          </div>
          <div class="mt-auto">
            <span class="text-white text-lg font-semibold">Start Hard Mode</span>
          </div>
        </Link>
      </div>

      <div class="mt-8">
        <Link href="/home" class="text-yellow-700 hover:text-yellow-800 font-medium">
          ← Back to Home
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.difficulty-card {
  @apply flex flex-col items-center text-center p-8 rounded-3xl shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl min-h-[280px];
}
</style>
