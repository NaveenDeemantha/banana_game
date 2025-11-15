<template>
  <div class="min-h-screen bg-animated-yellow flex flex-col items-center justify-center relative overflow-hidden py-6">
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
        <!-- <Link
          href="/login"
          class="px-4 py-2 bg-white text-yellow-700 border-2 border-yellow-400 rounded-lg shadow-lg hover:bg-yellow-50 transition-all duration-300 transform hover:scale-105 font-medium text-sm"
        >
          🔑 Login
        </Link> -->
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

    <div class="banana-card w-full max-w-4xl mx-4 max-h-[90vh] overflow-y-auto">
      <div class="flex items-center justify-between mb-3">
        <div>
          <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
            <span class="animate-float-y">🎯</span>
            Solve the Question!
          </h3>
          <div class="text-sm text-yellow-600">Level: {{ levelNames[levelParam] || levelParam }}</div>
        </div>
        <div class="text-right">
          <div class="text-3xl font-bold text-red-500">{{ remaining }}</div>
          <div class="text-xs text-red-400">seconds</div>
        </div>
      </div>

      <!-- Score Display -->
      <div class="mb-3 p-2 bg-white/80 rounded-lg flex justify-between items-center">
        <div class="text-center flex-1">
          <div class="text-xs text-gray-600">Score</div>
          <div class="text-lg font-bold text-yellow-700">{{ currentScore }}</div>
        </div>
        <div class="text-center flex-1">
          <div class="text-xs text-gray-600">Correct</div>
          <div class="text-lg font-bold text-green-600">{{ correctAnswers }}</div>
        </div>
        <div class="text-center flex-1">
          <div class="text-xs text-gray-600">Total</div>
          <div class="text-lg font-bold text-blue-600">{{ totalQuestions }}</div>
        </div>
      </div>

      <div v-if="imageSrc" class="mb-3 bg-white rounded-lg p-2 shadow-inner">
        <img :src="imageSrc" alt="question" class="mx-auto max-h-40 rounded-lg" />
      </div>

      <div v-else class="mb-3 bg-white rounded-lg p-4 shadow-inner">
        <div class="text-yellow-500 text-center">
          <div class="animate-spin text-3xl mb-1">🍌</div>
          <div class="text-gray-500">Loading question…</div>
        </div>
      </div>

      <input
        v-model="answer"
        :disabled="processing"
        type="number"
        placeholder="Enter your answer"
        @keyup.enter="handleSubmit(false)"
        class="w-full p-3 border-2 border-yellow-300 rounded-lg text-center focus:outline-none focus:border-yellow-500 mb-3 text-lg font-semibold bg-white/90"
      />

      <div class="flex gap-3">
        <button
          @click.prevent="handleSubmit(false)"
          :disabled="processing"
          class="flex-1 px-4 py-3 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold disabled:opacity-50"
        >
          Submit Answer
        </button>
        <button
          @click.prevent="skipQuestion"
          :disabled="processing"
          class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 font-medium disabled:opacity-50"
        >
          Skip
        </button>
      </div>

      <div v-if="feedback" class="mt-3 p-3 rounded-lg text-center font-medium" :class="feedback.ok ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
        {{ feedback.message }}
      </div>

      <div class="mt-4 flex gap-4 justify-center text-center">
        <Link href="/difficulty" class="text-yellow-700 hover:text-yellow-800 font-medium text-sm">
          ← Back to Difficulty
        </Link>
        <button @click="endGame" class="text-red-600 hover:text-red-700 font-medium text-sm">
          End Game
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import axios from 'axios';

const page = usePage();
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

// Score tracking
const currentScore = ref(0);
const correctAnswers = ref(0);
const totalQuestions = ref(0);
const gameStartTime = ref(Date.now());

async function fetchQuestion() {
  processing.value = true;
  feedback.value = null;
  try {
    const res = await fetch('https://marcconrad.com/uob/banana/api.php?out=json&base64=yes');
    const data = await res.json();
    if (data && data.question) {
      imageSrc.value = `data:image/png;base64,${data.question}`;
      solution.value = data.solution;
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
      handleSubmit(true);
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
  totalQuestions.value += 1;

  const user = Number(answer.value);
  const correct = !timedOut && solution.value !== null && user === Number(solution.value);

  if (correct) {
    correctAnswers.value += 1;
    // Award points based on difficulty and time remaining
    const basePoints = { easy: 10, medium: 20, hard: 30 }[levelParam] || 10;
    const timeBonus = remaining.value;
    currentScore.value += basePoints + timeBonus;
    feedback.value = { ok: true, message: `Correct! +${basePoints + timeBonus} points` };
  } else if (timedOut) {
    feedback.value = { ok: false, message: `Time's up — answer was ${solution.value}` };
  } else {
    feedback.value = { ok: false, message: `Wrong — answer was ${solution.value}` };
  }

  setTimeout(() => {
    answer.value = '';
    fetchQuestion();
  }, 1200);
}

function skipQuestion() {
  totalQuestions.value += 1;
  feedback.value = { ok: false, message: 'Question skipped' };
  clearTimer();
  setTimeout(() => {
    answer.value = '';
    fetchQuestion();
  }, 800);
}

async function endGame() {
  clearTimer();

  // Save score to database if user is authenticated
  if (page.props.auth?.user) {
    try {
      const timeTaken = Math.floor((Date.now() - gameStartTime.value) / 1000);

      await axios.post('/api/scores', {
        score: currentScore.value,
        correct_answers: correctAnswers.value,
        total_questions: totalQuestions.value,
        difficulty: levelParam,
        time_taken: timeTaken,
      });

      console.log('Score saved successfully!');
    } catch (error) {
      console.error('Failed to save score:', error);
    }
  }

  // Redirect to result page with stats
  router.visit('/result', {
    method: 'get',
    data: {
      score: currentScore.value,
      correct: correctAnswers.value,
      total: totalQuestions.value,
      difficulty: levelParam,
    },
  });
}

onMounted(() => {
  fetchQuestion();
  gameStartTime.value = Date.now();
});

onBeforeUnmount(() => {
  clearTimer();
});
</script>
