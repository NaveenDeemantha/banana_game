<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center overflow-hidden relative">
    <!-- Navigation Bar -->
    <nav class="absolute top-0 left-0 right-0 z-20 px-6 py-4">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2">
          <span class="text-4xl">🍌</span>
          <span class="text-2xl font-bold text-gray-800">Banana Catcher</span>
        </div>
        <div v-if="$page.props.auth?.user" class="flex items-center gap-3">
          <Link 
            href="/home"
            class="btn-secondary"
          >
            Home
          </Link>
          <Link 
            :href="route('logout')" 
            method="post" 
            as="button"
            class="btn-danger"
          >
            Logout
          </Link>
        </div>
      </div>
    </nav>

    <!-- Floating Decorative Elements -->
    <div class="absolute top-20 left-10 banana-icon-sm animate-float-smooth">🍌</div>
    <div class="absolute bottom-20 right-10 banana-icon-sm animate-float-smooth" style="animation-delay: 1s;">🍌</div>
    <div class="absolute top-1/3 right-16 banana-icon-sm animate-float-smooth" style="animation-delay: 2s;">🍌</div>
    <div class="absolute bottom-1/3 left-16 banana-icon-sm animate-float-smooth" style="animation-delay: 0.5s;">🍌</div>

    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-6 text-center z-10">
      <div class="mb-8 animate-pulse-subtle">
        <div class="banana-icon">🍌</div>
      </div>
      
      <h1 class="heading-1 mb-6 bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
        Banana Catcher
      </h1>
      
      <p class="text-xl md:text-2xl text-gray-700 mb-12 max-w-2xl mx-auto font-medium">
        Test your math skills and reflexes! Solve equations before time runs out in this exciting mathematical adventure.
      </p>

      <!-- Feature Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="stat-card">
          <div class="text-4xl mb-3">⚡</div>
          <h3 class="font-bold text-gray-800 mb-2">Fast-Paced</h3>
          <p class="text-sm text-muted">Race against the clock</p>
        </div>
        <div class="stat-card">
          <div class="text-4xl mb-3">🎯</div>
          <h3 class="font-bold text-gray-800 mb-2">Multiple Levels</h3>
          <p class="text-sm text-muted">Easy, Medium, and Hard</p>
        </div>
        <div class="stat-card">
          <div class="text-4xl mb-3">🏆</div>
          <h3 class="font-bold text-gray-800 mb-2">Compete</h3>
          <p class="text-sm text-muted">Climb the leaderboard</p>
        </div>
      </div>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <Link 
          v-if="$page.props.auth?.user"
          href="/difficulty" 
          class="btn-primary text-lg px-8 py-4"
        >
          Start Playing
        </Link>
        <template v-else>
          <Link 
            :href="route('register')" 
            class="btn-primary text-lg px-8 py-4"
          >
            Get Started
          </Link>
          <Link 
            :href="route('login')" 
            class="btn-secondary text-lg px-8 py-4"
          >
            Login
          </Link>
        </template>
        <Link 
          href="/leaderboard" 
          class="btn-secondary text-lg px-8 py-4"
        >
          View Leaderboard
        </Link>
      </div>
    </div>

    <!-- Bottom Wave Decoration -->
    <div class="absolute bottom-0 left-0 right-0 opacity-20">
      <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-24">
        <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F59E0B"/>
      </svg>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
