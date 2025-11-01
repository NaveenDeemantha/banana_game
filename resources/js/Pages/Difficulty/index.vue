<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden p-6">
    <!-- Navigation Bar -->
    <nav class="absolute top-0 left-0 right-0 z-20 px-6 py-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <Link href="/home" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
          <span class="text-3xl">🍌</span>
          <span class="text-xl font-bold text-gray-800">Banana Catcher</span>
        </Link>
        <Link 
          v-if="$page.props.auth?.user"
          :href="route('logout')" 
          method="post" 
          as="button"
          class="btn-danger"
        >
          Logout
        </Link>
      </div>
    </nav>

    <!-- Floating Decorative Elements -->
    <div class="absolute top-20 left-10 banana-icon-sm animate-float-smooth">🍌</div>
    <div class="absolute bottom-20 right-10 banana-icon-sm animate-float-smooth" style="animation-delay: 1s;">🍌</div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto text-center z-10 mt-12">
      <div class="mb-10">
        <div class="text-6xl mb-4 animate-pulse-subtle">🎯</div>
        <h2 class="heading-2 mb-3 bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
          Choose Your Challenge
        </h2>
        <p class="text-lg text-gray-700">Select a difficulty level and start playing</p>
      </div>

      <!-- Difficulty Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Easy Level -->
        <Link href="/play?level=easy" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-green-400 to-emerald-500 text-white min-h-[280px] flex flex-col justify-between">
            <div class="flex flex-col items-center">
              <div class="text-7xl mb-4 group-hover:scale-110 transition-transform">🥥</div>
              <h3 class="text-3xl font-bold mb-3">Easy</h3>
            </div>
            <div class="space-y-2 text-center mb-4">
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">⏱️</span>
                <span class="text-sm font-medium">12 seconds per question</span>
              </div>
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">�</span>
                <span class="text-sm font-medium">Perfect for beginners</span>
              </div>
              <div class="mt-4 px-4 py-2 bg-white/20 rounded-lg backdrop-blur-sm">
                <p class="text-xs text-white/80">Base Score: 10 points + time bonus</p>
              </div>
            </div>
            <button class="w-full btn-primary bg-white text-green-600 hover:bg-green-50 hover:scale-100 shadow-md">
              Start Easy Mode
            </button>
          </div>
        </Link>

        <!-- Medium Level -->
        <Link href="/play?level=medium" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-amber-400 to-orange-500 text-white min-h-[280px] flex flex-col justify-between">
            <div class="flex flex-col items-center">
              <div class="text-7xl mb-4 group-hover:scale-110 transition-transform">🍍</div>
              <h3 class="text-3xl font-bold mb-3">Medium</h3>
            </div>
            <div class="space-y-2 text-center mb-4">
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">⏱️</span>
                <span class="text-sm font-medium">8 seconds per question</span>
              </div>
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">�</span>
                <span class="text-sm font-medium">Moderate challenge</span>
              </div>
              <div class="mt-4 px-4 py-2 bg-white/20 rounded-lg backdrop-blur-sm">
                <p class="text-xs text-white/80">Base Score: 20 points + time bonus</p>
              </div>
            </div>
            <button class="w-full btn-primary bg-white text-orange-600 hover:bg-orange-50 hover:scale-100 shadow-md">
              Start Medium Mode
            </button>
          </div>
        </Link>

        <!-- Hard Level -->
        <Link href="/play?level=hard" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-red-400 to-rose-500 text-white min-h-[280px] flex flex-col justify-between">
            <div class="flex flex-col items-center">
              <div class="text-7xl mb-4 group-hover:scale-110 transition-transform">🌶️</div>
              <h3 class="text-3xl font-bold mb-3">Hard</h3>
            </div>
            <div class="space-y-2 text-center mb-4">
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">⏱️</span>
                <span class="text-sm font-medium">5 seconds per question</span>
              </div>
              <div class="flex items-center justify-center gap-2 text-white/90">
                <span class="text-xl">�</span>
                <span class="text-sm font-medium">Expert level only</span>
              </div>
              <div class="mt-4 px-4 py-2 bg-white/20 rounded-lg backdrop-blur-sm">
                <p class="text-xs text-white/80">Base Score: 30 points + time bonus</p>
              </div>
            </div>
            <button class="w-full btn-primary bg-white text-red-600 hover:bg-red-50 hover:scale-100 shadow-md">
              Start Hard Mode
            </button>
          </div>
        </Link>
      </div>

      <!-- Back Link -->
      <div class="mt-10">
        <Link href="/home" class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-900 font-medium transition-colors">
          <span>←</span>
          <span>Back to Home</span>
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
