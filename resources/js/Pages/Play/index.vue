<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden">
    <!-- Floating corner bananas -->
    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>

    <div class="banana-card w-full max-w-lg mx-4">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h3 class="text-2xl font-bold text-yellow-700 flex items-center gap-2">
            <span class="animate-float-y">🎯</span>
            Solve the Question!
          </h3>
          <div class="text-sm text-yellow-600 mt-1">Level: {{ levelNames[levelParam] || levelParam }}</div>
        </div>
        <div class="text-right">
          <div class="text-3xl font-bold text-red-500">{{ remaining }}</div>
          <div class="text-xs text-red-400">seconds</div>
        </div>
      </div>

      <div v-if="imageSrc" class="mb-6 bg-white rounded-xl p-4 shadow-inner">
        <img :src="imageSrc" alt="question" class="mx-auto max-h-48 rounded-lg" />
      </div>

      <div v-else class="mb-6 bg-white rounded-xl p-8 shadow-inner">
        <div class="text-yellow-500 text-center">
          <div class="animate-spin text-4xl mb-2">🍌</div>
          <div class="text-gray-500">Loading question…</div>
        </div>
      </div>

      <!-- TESTING SECTION - Shows the correct answer for debugging -->
      <div v-if="solution !== null" class="mb-4 p-3 bg-red-100 border-2 border-red-300 rounded-xl text-center">
        <div class="text-red-600 font-bold text-sm mb-1"> TESTING MODE </div>
        <div class="text-red-800 font-bold text-lg">Correct Answer: {{ solution }}</div>
        <div class="text-red-500 text-xs mt-1">Remove this section before production!</div>
      </div>

      <input
        v-model="answer"
        :disabled="processing"
        type="number"
        placeholder="Enter your answer"
        class="w-full p-4 border-2 border-yellow-300 rounded-xl text-center focus:outline-none focus:border-yellow-500 mb-6 text-lg font-semibold bg-white/90"
      />

      <div class="flex gap-4">
        <button 
          @click.prevent="handleSubmit(false)" 
          :disabled="processing" 
          class="flex-1 px-6 py-4 bg-yellow-500 text-white rounded-xl shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold text-lg"
        >
          Submit Answer
        </button>
        <button 
          @click.prevent="fetchQuestion" 
          :disabled="processing" 
          class="px-6 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 font-medium"
        >
          Skip
        </button>
      </div>

      <div v-if="feedback" class="mt-6 p-4 rounded-xl text-center font-medium text-lg" :class="feedback.ok ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
        {{ feedback.message }}
      </div>

      <div class="mt-6 text-center">
        <Link href="/difficulty" class="text-yellow-700 hover:text-yellow-800 font-medium">
          ← Back to Difficulty
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link } from '@inertiajs/vue3';

const levelParam = new URLSearchParams(window.location.search).get('level') || 'easy';
const levelNames = { easy: 'Easy', medium: 'Medium', hard: 'Hard' };
const levelTimes = { easy: 12, medium: 8, hard: 5 };

const imageSrc = ref(null);
const solution = ref(null);
const answer = ref('');
const remaining = ref(levelTimes[levelParam] ?? 12);
const processing = ref(false);
const feedback = ref(null);
const timerId = ref(null);

async function fetchQuestion() {
  processing.value = true;
  feedback.value = null;
  try {
    const res = await fetch('https://marcconrad.com/uob/banana/api.php?out=json&base64=yes');
    const data = await res.json();
    // API returns { question: <base64string>, solution: <number> }
    if (data && data.question) {
      imageSrc.value = `data:image/png;base64,${data.question}`;
      solution.value = data.solution;
      // reset timer
      remaining.value = levelTimes[levelParam] ?? 12;
      startTimer();
    } else {
      feedback.value = { ok: false, message: 'Invalid question from API' };
    }
  } catch (e) {
    feedback.value = { ok: false, message: 'Failed to fetch question' };
    console.error(e);
  } finally {
    processing.value = false;
  }
}

function startTimer() {
  clearTimer();
  timerId.value = setInterval(() => {
    remaining.value -= 1;
    if (remaining.value <= 0) {
      clearTimer();
      handleSubmit(true); // timed out
    }
  }, 1000);
}

function clearTimer() {
  if (timerId.value) {
    clearInterval(timerId.value);
    timerId.value = null;
  }
}

function handleSubmit(timedOut = false) {
  clearTimer();
  const user = Number(answer.value);
  const correct = !timedOut && solution.value !== null && user === Number(solution.value);
  if (correct) {
    feedback.value = { ok: true, message: 'Correct!' };
  } else if (timedOut) {
    feedback.value = { ok: false, message: `Time's up — answer was ${solution.value}` };
  } else {
    feedback.value = { ok: false, message: `Wrong — answer was ${solution.value}` };
  }
  // show feedback then fetch next after a short delay
  setTimeout(() => {
    answer.value = '';
    fetchQuestion();
  }, 1200);
}

onMounted(() => {
  fetchQuestion();
});

onBeforeUnmount(() => {
  clearTimer();
});
</script>
