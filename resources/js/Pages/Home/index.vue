<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden">
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
    <div class="absolute top-1/4 right-8 banana-header-icon animate-float-y" style="animation-delay: 2s;">🍌</div>
    <div class="absolute bottom-1/4 left-8 banana-header-icon animate-float-y" style="animation-delay: 0.5s;">🍌</div>

    <transition name="welcome">
      <div v-if="showWelcome" class="text-center mb-12">
        <div class="text-8xl mb-6 animate-float-y">🍌</div>
        <h1 class="text-6xl font-bold text-yellow-800 mb-4 drop-shadow-lg">
          Welcome Back!
        </h1>
        <p class="text-xl text-yellow-700/80 max-w-md mx-auto">
          Ready to catch some bananas and test your math skills?
        </p>
      </div>
    </transition>

    <transition name="menu">
      <div v-if="showMenu" class="w-full max-w-4xl px-4">
        <div class="banana-card">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <Link 
              v-for="(item, index) in menuItems" 
              :key="index"
              :href="item.href" 
              :class="[item.bgColor, item.hoverColor]"
              class="menu-card group"
              :style="{ animationDelay: `${index * 150}ms` }"
            >
              <div class="flex items-center justify-between mb-4">
                <div class="text-4xl group-hover:animate-bounce">{{ item.icon }}</div>
                <div class="w-2 h-2 bg-white/50 rounded-full group-hover:scale-150 transition-transform"></div>
              </div>
              <div class="text-left">
                <h3 class="text-xl font-bold text-white mb-2">{{ item.title }}</h3>
                <p class="text-white/80 text-sm leading-relaxed">{{ item.description }}</p>
              </div>
              <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="text-white text-xl">→</div>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </transition>

    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
      <div class="text-yellow-600/60 text-sm animate-pulse">
        🍌 Catch bananas, solve math, have fun! 🍌
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const showWelcome = ref(false);
const showMenu = ref(false);

onMounted(() => {
  setTimeout(() => {
    showWelcome.value = true;
  }, 300);
  setTimeout(() => {
    showMenu.value = true;
  }, 800);
});

const menuItems = [
  {
    href: '/difficulty',
    title: 'Start Game',
    description: 'Choose your difficulty and begin',
    icon: '🎮',
    bgColor: 'bg-gradient-to-br from-yellow-400 to-yellow-500',
    hoverColor: 'hover:from-yellow-500 hover:to-yellow-600'
  },
  {
    href: '/leaderboard',
    title: 'Leaderboard',
    description: 'See who\'s the top banana catcher',
    icon: '🏆',
    bgColor: 'bg-gradient-to-br from-green-400 to-green-500',
    hoverColor: 'hover:from-green-500 hover:to-green-600'
  },
  {
    href: '/profile',
    title: 'Profile',
    description: 'Manage your account settings',
    icon: '👤',
    bgColor: 'bg-gradient-to-br from-blue-400 to-blue-500',
    hoverColor: 'hover:from-blue-500 hover:to-blue-600'
  },
  {
    href: '/settings',
    title: 'Settings',
    description: 'Customize your game experience',
    icon: '⚙️',
    bgColor: 'bg-gradient-to-br from-orange-400 to-orange-500',
    hoverColor: 'hover:from-orange-500 hover:to-orange-600'
  }
];
</script>

<style scoped>
.welcome-enter-active {
  transition: all 0.8s ease-out;
}
.welcome-enter-from {
  opacity: 0;
  transform: translateY(-30px);
}

.menu-enter-active {
  transition: all 1s ease-out;
}
.menu-enter-from {
  opacity: 0;
  transform: translateY(50px);
}

.menu-card {
  @apply relative p-6 rounded-2xl text-white shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-fade-in-up;
}

.banana-card {
  @apply bg-yellow-50/95 border border-yellow-200 rounded-2xl p-8 shadow-lg backdrop-blur-sm;
}

@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fade-in-up 0.6s ease-out forwards;
  opacity: 0;
}
</style>
