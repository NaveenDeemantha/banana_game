<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Mock data - in a real app this would come from props/API
const stats = {
  totalGames: 127,
  bestScore: 98,
  averageScore: 73,
  totalBananas: 1250,
  currentStreak: 5,
  rank: 12
};

const recentGames = [
  { date: '2025-10-25', score: 85, difficulty: 'Medium', duration: '2:15' },
  { date: '2025-10-24', score: 92, difficulty: 'Hard', duration: '1:45' },
  { date: '2025-10-23', score: 67, difficulty: 'Easy', duration: '3:20' }
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-yellow-700">
                Dashboard
            </h2>
        </template>

        <div class="py-12 bg-animated-yellow">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="banana-card mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-yellow-700 flex items-center gap-2">
                                <span class="animate-float-y">🍌</span>
                                Welcome back, Banana Catcher!
                            </h3>
                            <p class="text-yellow-600 mt-2">Ready for another math adventure?</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-yellow-700">#{{ stats.rank }}</div>
                            <div class="text-sm text-yellow-600">Global Rank</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                    <div class="banana-card text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ stats.totalGames }}</div>
                        <div class="text-sm text-yellow-700">Total Games</div>
                    </div>
                    <div class="banana-card text-center">
                        <div class="text-3xl font-bold text-green-600">{{ stats.bestScore }}</div>
                        <div class="text-sm text-yellow-700">Best Score</div>
                    </div>
                    <div class="banana-card text-center">
                        <div class="text-3xl font-bold text-orange-600">{{ stats.averageScore }}</div>
                        <div class="text-sm text-yellow-700">Average Score</div>
                    </div>
                    <div class="banana-card text-center">
                        <div class="text-3xl font-bold text-yellow-600">{{ stats.totalBananas }}</div>
                        <div class="text-sm text-yellow-700">Bananas Caught 🍌</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Quick Actions -->
                    <div class="banana-card">
                        <h3 class="text-xl font-bold text-yellow-700 mb-6 flex items-center gap-2">
                            <span>🎮</span>
                            Quick Actions
                        </h3>
                        <div class="grid grid-cols-1 gap-4">
                            <Link href="/difficulty" class="quick-action-btn bg-yellow-500 hover:bg-yellow-600">
                                <span class="text-2xl">🎯</span>
                                <div>
                                    <div class="font-semibold">Start New Game</div>
                                    <div class="text-sm opacity-80">Choose difficulty and play</div>
                                </div>
                            </Link>
                            <Link href="/leaderboard" class="quick-action-btn bg-green-500 hover:bg-green-600">
                                <span class="text-2xl">🏆</span>
                                <div>
                                    <div class="font-semibold">View Leaderboard</div>
                                    <div class="text-sm opacity-80">See top players</div>
                                </div>
                            </Link>
                            <Link href="/profile" class="quick-action-btn bg-blue-500 hover:bg-blue-600">
                                <span class="text-2xl">👤</span>
                                <div>
                                    <div class="font-semibold">Edit Profile</div>
                                    <div class="text-sm opacity-80">Update your information</div>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- Recent Games -->
                    <div class="banana-card">
                        <h3 class="text-xl font-bold text-yellow-700 mb-6 flex items-center gap-2">
                            <span>📊</span>
                            Recent Games
                        </h3>
                        <div class="space-y-4">
                            <div v-for="(game, index) in recentGames" :key="index" 
                                 class="flex items-center justify-between p-4 bg-white/50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ game.score }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">{{ game.difficulty }} Mode</div>
                                        <div class="text-sm text-gray-600">{{ game.date }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-600">{{ game.duration }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <Link href="/leaderboard" class="text-yellow-700 hover:text-yellow-800 font-medium">
                                View All Games →
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Achievement Section -->
                <!-- <div class="banana-card mt-8">
                    <h3 class="text-xl font-bold text-yellow-700 mb-6 flex items-center gap-2">
                        <span>🏅</span>
                        Recent Achievements
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="achievement-card bg-yellow-100">
                            <div class="text-3xl mb-2">🔥</div>
                            <div class="font-semibold text-yellow-800">Hot Streak</div>
                            <div class="text-sm text-yellow-700">{{ stats.currentStreak }} games in a row</div>
                        </div>
                        <div class="achievement-card bg-green-100">
                            <div class="text-3xl mb-2">🎯</div>
                            <div class="font-semibold text-green-800">Sharp Shooter</div>
                            <div class="text-sm text-green-700">90%+ accuracy in last game</div>
                        </div>
                        <div class="achievement-card bg-blue-100">
                            <div class="text-3xl mb-2">⚡</div>
                            <div class="font-semibold text-blue-800">Speed Demon</div>
                            <div class="text-sm text-blue-700">Completed hard mode in under 2 min</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.quick-action-btn {
  @apply flex items-center gap-4 p-4 text-white rounded-lg transition-all duration-300 transform hover:scale-105;
}

.achievement-card {
  @apply p-4 rounded-lg text-center;
}
</style>
