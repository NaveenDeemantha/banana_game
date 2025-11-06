<template>
  <AuthenticatedLayout>
    <Head title="Edit Score" />

    <div class="py-12">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Score</h2>
            <p class="text-gray-600 mt-1">Update score information for {{ score.user?.name }}</p>
          </div>

          <form @submit.prevent="submit">
            <div class="space-y-6">
              <!-- Player Info (Read-only) -->
              <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">Player</p>
                <p class="text-lg font-semibold text-gray-900">{{ score.user?.name }}</p>
                <p class="text-sm text-gray-600">{{ score.user?.email }}</p>
              </div>

              <!-- Score -->
              <div>
                <label for="score" class="block text-sm font-medium text-gray-700">Score</label>
                <input
                  id="score"
                  type="number"
                  v-model.number="form.score"
                  min="0"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.score" class="mt-1 text-sm text-red-600">{{ form.errors.score }}</p>
              </div>

              <!-- Difficulty -->
              <div>
                <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
                <select
                  id="difficulty"
                  v-model="form.difficulty"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                >
                  <option value="easy">Easy</option>
                  <option value="medium">Medium</option>
                  <option value="hard">Hard</option>
                </select>
                <p v-if="form.errors.difficulty" class="mt-1 text-sm text-red-600">{{ form.errors.difficulty }}</p>
              </div>

              <!-- Correct Answers -->
              <div>
                <label for="correct_answers" class="block text-sm font-medium text-gray-700">Correct Answers</label>
                <input
                  id="correct_answers"
                  type="number"
                  v-model.number="form.correct_answers"
                  min="0"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.correct_answers" class="mt-1 text-sm text-red-600">{{ form.errors.correct_answers }}</p>
              </div>

              <!-- Total Questions -->
              <div>
                <label for="total_questions" class="block text-sm font-medium text-gray-700">Total Questions</label>
                <input
                  id="total_questions"
                  type="number"
                  v-model.number="form.total_questions"
                  min="0"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                  required
                />
                <p v-if="form.errors.total_questions" class="mt-1 text-sm text-red-600">{{ form.errors.total_questions }}</p>
              </div>

              <!-- Time Taken -->
              <div>
                <label for="time_taken" class="block text-sm font-medium text-gray-700">Time Taken (seconds)</label>
                <input
                  id="time_taken"
                  type="number"
                  v-model.number="form.time_taken"
                  min="0"
                  class="mt-1 block w-full rounded-lg border-gray-300"
                />
                <p v-if="form.errors.time_taken" class="mt-1 text-sm text-red-600">{{ form.errors.time_taken }}</p>
              </div>

              <!-- Accuracy Display -->
              <div class="p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600">Calculated Accuracy</p>
                <p class="text-2xl font-bold text-gray-900">
                  {{ form.total_questions > 0 ? Math.round((form.correct_answers / form.total_questions) * 100) : 0 }}%
                </p>
              </div>

              <!-- Buttons -->
              <div class="flex items-center justify-end gap-4">
                <Link :href="route('admin.scores.index')" class="btn-secondary">
                  Cancel
                </Link>
                <button type="submit" class="btn-primary" :disabled="form.processing">
                  Update Score
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  score: Object,
});

const form = useForm({
  score: props.score.score,
  difficulty: props.score.difficulty,
  correct_answers: props.score.correct_answers,
  total_questions: props.score.total_questions,
  time_taken: props.score.time_taken,
});

function submit() {
  form.put(route('admin.scores.update', props.score.id));
}
</script>
