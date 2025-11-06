<template>
  <AuthenticatedLayout>
    <Head title="Score Details" />

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="flex justify-between items-start">
            <div>
              <h2 class="text-3xl font-bold text-gray-800">Score Details</h2>
              <p class="text-gray-600 mt-1">Complete information about this game session</p>
            </div>
            <Link :href="route('admin.scores.index')" class="btn-secondary">
              Back to List
            </Link>
          </div>
        </div>

        <!-- Score Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-8 text-white">
          <div class="text-center">
            <div class="text-6xl mb-4">🏆</div>
            <p class="text-purple-100 text-sm uppercase">Total Score</p>
            <p class="text-6xl font-bold my-4">{{ score.score }}</p>
            <span 
              :class="getDifficultyClass(score.difficulty)"
              class="px-4 py-2 text-sm font-semibold rounded-full"
            >
              {{ score.difficulty.toUpperCase() }} MODE
            </span>
          </div>
        </div>

        <!-- Player Info -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Player Information</h3>
          <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
            <div class="text-5xl">🎮</div>
            <div>
              <p class="text-lg font-semibold text-gray-900">{{ score.user?.name || 'Unknown Player' }}</p>
              <p class="text-sm text-gray-600">{{ score.user?.email }}</p>
              <Link 
                v-if="score.user" 
                :href="route('admin.users.show', score.user.id)"
                class="text-sm text-blue-600 hover:text-blue-800 mt-1 inline-block"
              >
                View Player Profile →
              </Link>
            </div>
          </div>
        </div>

        <!-- Game Statistics -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Game Statistics</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-green-50 rounded-lg">
              <p class="text-sm text-gray-600">Correct Answers</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">{{ score.correct_answers }}</p>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg">
              <p class="text-sm text-gray-600">Total Questions</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">{{ score.total_questions }}</p>
            </div>
            <div class="p-4 bg-purple-50 rounded-lg">
              <p class="text-sm text-gray-600">Accuracy</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">
                {{ Math.round((score.correct_answers / score.total_questions) * 100) }}%
              </p>
            </div>
            <div class="p-4 bg-orange-50 rounded-lg">
              <p class="text-sm text-gray-600">Time Taken</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">{{ score.time_taken }}s</p>
            </div>
          </div>
        </div>

        <!-- Additional Details -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Session Details</h3>
          <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <dt class="text-sm font-medium text-gray-500">Score ID</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ score.id }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Player ID</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ score.user_id }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Difficulty Level</dt>
              <dd class="mt-1">
                <span 
                  :class="getDifficultyClass(score.difficulty)"
                  class="px-2 py-1 text-xs font-semibold rounded-full"
                >
                  {{ score.difficulty }}
                </span>
              </dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Game Played</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ formatDate(score.created_at) }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ formatDate(score.updated_at) }}</dd>
            </div>
            <div>
              <dt class="text-sm font-medium text-gray-500">Questions Per Minute</dt>
              <dd class="mt-1 text-sm text-gray-900">
                {{ score.time_taken > 0 ? Math.round((score.total_questions / score.time_taken) * 60) : 0 }}
              </dd>
            </div>
          </dl>
        </div>

        <!-- Actions -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4">Actions</h3>
          <div class="flex gap-4">
            <Link :href="route('admin.scores.edit', score.id)" class="btn-primary">
              Edit Score
            </Link>
            <button @click="deleteScore" class="btn-danger">
              Delete Score
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
  score: Object,
});

function deleteScore() {
  if (confirm('Are you sure you want to delete this score?')) {
    router.delete(route('admin.scores.destroy', props.score.id), {
      onSuccess: () => router.visit(route('admin.scores.index')),
    });
  }
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
}

function getDifficultyClass(difficulty) {
  const classes = {
    easy: 'bg-green-100 text-green-800',
    medium: 'bg-yellow-100 text-yellow-800',
    hard: 'bg-red-100 text-red-800',
  };
  return classes[difficulty] || 'bg-gray-100 text-gray-800';
}
</script>
