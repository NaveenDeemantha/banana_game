<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center text-center overflow-hidden relative">
    <div class="absolute top-10 left-10 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute bottom-10 right-10 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>
    <div class="absolute top-1/3 right-10 banana-header-icon animate-float-y" style="animation-delay: 2s;">🍌</div>
    <div class="absolute bottom-1/3 left-10 banana-header-icon animate-float-y" style="animation-delay: 0.5s;">🍌</div>

    <transition name="fade">
      <div class="banana-card max-w-2xl mx-4">
        <div class="text-8xl mb-6 animate-float-y">🍌</div>
        <h1 class="text-6xl font-extrabold text-yellow-700 drop-shadow-lg mb-6">
          Banana Catcher
        </h1>
        <p class="text-xl text-yellow-800/80 mb-8 max-w-lg mx-auto leading-relaxed">
          Test your math speed and catch bananas before the timer runs out! Race against time in this exciting mathematical adventure. 🕒
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
          <div class="bg-yellow-100/50 rounded-lg p-4">
            <div class="text-2xl mb-2">⚡</div>
            <div class="text-sm font-medium text-yellow-800">Lightning Fast</div>
          </div>
          <div class="bg-yellow-100/50 rounded-lg p-4">
            <div class="text-2xl mb-2">🎯</div>
            <div class="text-sm font-medium text-yellow-800">Multiple Levels</div>
          </div>
          <div class="bg-yellow-100/50 rounded-lg p-4">
            <div class="text-2xl mb-2">🏆</div>
            <div class="text-sm font-medium text-yellow-800">Leaderboards</div>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link href="/login" class="enhanced-btn bg-yellow-500 hover:bg-yellow-600 text-white">
            <span class="text-xl mr-2">🎮</span>
            Start Playing
          </Link>
          <Link href="/register" class="enhanced-btn bg-white hover:bg-yellow-50 text-yellow-700 border-2 border-yellow-400">
            <span class="text-xl mr-2">✨</span>
            Create Account
          </Link>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.8s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

.enhanced-btn {
  @apply px-8 py-4 rounded-2xl shadow-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl;
}
</style>
