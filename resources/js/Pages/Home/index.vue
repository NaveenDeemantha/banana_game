<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden p-6">
    <!-- Navigation Bar -->
    <nav class="absolute top-0 left-0 right-0 z-20 px-6 py-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2">
          <span class="text-3xl">🍌</span>
          <span class="text-xl font-bold text-gray-800">Banana Catcher</span>
        </div>
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
      <div class="mb-8">
        <div class="text-7xl mb-6 animate-pulse-subtle">🍌</div>
        <h1 class="heading-2 mb-3 bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
          Welcome Back!
        </h1>
        <p class="text-lg text-gray-700 max-w-md mx-auto">
          Ready to test your math skills?
        </p>
      </div>

      <!-- Menu Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
        <!-- Start Game Card -->
        <Link href="/difficulty" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-amber-400 to-amber-500 text-white min-h-[200px] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
              <div class="text-5xl group-hover:scale-110 transition-transform">🎮</div>
              <div class="w-3 h-3 bg-white/50 rounded-full group-hover:scale-150 transition-transform"></div>
            </div>
            <div class="text-left">
              <h3 class="text-2xl font-bold mb-2">Start Game</h3>
              <p class="text-white/90 text-sm">Choose your difficulty and begin the adventure</p>
            </div>
            <div class="text-right mt-4">
              <span class="text-white/80 text-sm font-medium group-hover:text-white transition-colors">Play Now →</span>
            </div>
          </div>
        </Link>

        <!-- Leaderboard Card -->
        <Link href="/leaderboard" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-green-400 to-emerald-500 text-white min-h-[200px] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
              <div class="text-5xl group-hover:scale-110 transition-transform">🏆</div>
              <div class="w-3 h-3 bg-white/50 rounded-full group-hover:scale-150 transition-transform"></div>
            </div>
            <div class="text-left">
              <h3 class="text-2xl font-bold mb-2">Leaderboard</h3>
              <p class="text-white/90 text-sm">See who's the top banana catcher</p>
            </div>
            <div class="text-right mt-4">
              <span class="text-white/80 text-sm font-medium group-hover:text-white transition-colors">View Rankings →</span>
            </div>
          </div>
        </Link>

        <!-- Profile Card -->
        <Link href="/profile" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-blue-400 to-blue-500 text-white min-h-[200px] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
              <div class="text-5xl group-hover:scale-110 transition-transform">👤</div>
              <div class="w-3 h-3 bg-white/50 rounded-full group-hover:scale-150 transition-transform"></div>
            </div>
            <div class="text-left">
              <h3 class="text-2xl font-bold mb-2">Profile</h3>
              <p class="text-white/90 text-sm">Manage your account and view stats</p>
            </div>
            <div class="text-right mt-4">
              <span class="text-white/80 text-sm font-medium group-hover:text-white transition-colors">Manage →</span>
            </div>
          </div>
        </Link>

        <!-- Settings Card -->
        <Link href="/settings" class="game-card group hover:-translate-y-2">
          <div class="p-8 bg-gradient-to-br from-purple-400 to-purple-500 text-white min-h-[200px] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
              <div class="text-5xl group-hover:scale-110 transition-transform">⚙️</div>
              <div class="w-3 h-3 bg-white/50 rounded-full group-hover:scale-150 transition-transform"></div>
            </div>
            <div class="text-left">
              <h3 class="text-2xl font-bold mb-2">Settings</h3>
              <p class="text-white/90 text-sm">Customize your game experience</p>
            </div>
            <div class="text-right mt-4">
              <span class="text-white/80 text-sm font-medium group-hover:text-white transition-colors">Configure →</span>
            </div>
          </div>
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
