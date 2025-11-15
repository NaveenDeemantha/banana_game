<template>
  <div class="game-container">
    <div class="user-menu">
      <Link
        v-if="$page.props.auth?.user"
        :href="route('logout')"
        method="post"
        as="button"
        class="logout-btn"
      >
        🚪 Logout
      </Link>
      <div v-else class="auth-links">
        <!-- <Link
          href="/login"
          class="login-btn"
        >
          🔑 Login
        </Link> -->
        <Link
          href="/register"
          class="register-btn"
        >
          ✨ Register
        </Link>
      </div>
    </div>

    <div class="banana-icon-left">🍌</div>
    <div class="banana-icon-right delay-1s">🍌</div>

    <div class="game-card">
      <div class="header-section">
        <div>
          <h3 class="question-title">
            <span class="target-icon">🎯</span>
            Solve the Question!
          </h3>
          <div class="level-info">Level: {{ levelNames[levelParam] || levelParam }}</div>
        </div>
        <div class="timer">
          <div class="timer-value">{{ remaining }}</div>
          <div class="timer-label">seconds</div>
        </div>
      </div>

      <!-- Score Display -->
      <div class="score-display">
        <div class="score-item">
          <div class="score-label">Score</div>
          <div class="score-value">{{ currentScore }}</div>
        </div>
        <div class="score-item">
          <div class="score-label">Correct</div>
          <div class="score-value-correct">{{ correctAnswers }}</div>
        </div>
        <div class="score-item">
          <div class="score-label">Total</div>
          <div class="score-value-total">{{ totalQuestions }}</div>
        </div>
      </div>

      <div class="question-section">
        <!-- Left side: Question Image -->
        <div class="image-container">
          <div v-if="imageSrc" class="question-image">
            <img :src="imageSrc" alt="question" class="question-img" />
          </div>

          <div v-else class="loading">
            <div class="loading-icon">🍌</div>
            <div class="loading-text">Loading question…</div>
          </div>
        </div>

        <!-- Right side: Answer Input & Buttons -->
        <div class="answer-container">
          <input
            ref="answerInput"
            v-model="answer"
            :disabled="processing"
            type="number"
            placeholder="Enter your answer"
            @keyup.enter="handleSubmit(false)"
            class="answer-input"
          />

          <div class="buttons">
            <button
              @click.prevent="handleSubmit(false)"
              :disabled="processing"
              class="submit-btn"
            >
              Submit Answer
            </button>
            <button
              @click.prevent="skipQuestion"
              :disabled="processing"
              class="skip-btn"
            >
              Skip
            </button>
          </div>
        </div>
      </div>

      <div v-if="feedback" class="feedback" :class="feedback.ok ? 'feedback-success' : 'feedback-error'">
        {{ feedback.message }}
      </div>

      <div class="nav-links">
        <Link href="/difficulty" class="back-link">
          ← Back to Difficulty
        </Link>
        <button @click="endGame" class="end-btn">
          End Game
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { useBackgroundMusic } from '@/composables/useBackgroundMusic';

const { initAudio } = useBackgroundMusic();

const page = usePage();
const levelParam = new URLSearchParams(window.location.search).get('level') || 'easy';
const levelNames = { easy: 'Easy', medium: 'Medium', hard: 'Hard' };
const levelTimes = { easy: 12, medium: 8, hard: 5 };

const levelRanges = {
  easy: { min: 0, max: 3 },
  medium: { min: 4, max: 6 },
  hard: { min: 7, max: 10 }
};

const answerInput = ref(null);
const imageSrc = ref(null);
const solution = ref(null);
const answer = ref('');
const remaining = ref(levelTimes[levelParam] ?? 12);
const processing = ref(false);
const feedback = ref(null);
const timerId = ref(null);

const currentScore = ref(0);
const correctAnswers = ref(0);
const totalQuestions = ref(0);
const gameStartTime = ref(Date.now());

async function fetchQuestion() {
  processing.value = true;
  feedback.value = null;

  let questionData = null;
  let attempts = 0;
  const maxAttempts = 50;

  try {
    const range = levelRanges[levelParam];
    console.log(`Fetching question for ${levelParam} mode. Range: ${range.min}-${range.max}`);

    while (attempts < maxAttempts && !questionData) {
      const res = await fetch('https://marcconrad.com/uob/banana/api.php?out=json&base64=yes');
      const data = await res.json();

      if (data && data.question && data.solution !== undefined) {
        const answerValue = parseInt(data.solution, 10);
        console.log(`Attempt ${attempts + 1}: Got answer ${answerValue}, need ${range.min}-${range.max}`);

        if (answerValue >= range.min && answerValue <= range.max) {
          questionData = data;
          console.log(`✓ Accepted question with answer ${answerValue}`);
        }
      }

      attempts++;
    }

    if (questionData) {
      imageSrc.value = `data:image/png;base64,${questionData.question}`;
      solution.value = parseInt(questionData.solution, 10);
      remaining.value = levelTimes[levelParam] ?? 12;
      startTimer();
      await nextTick();
      answerInput.value?.focus();
    } else {
      feedback.value = { ok: false, message: 'Could not find question for this difficulty. Please try again.' };
      console.error(`Failed to find matching question after ${maxAttempts} attempts`);
    }
  } catch (e) {
    feedback.value = { ok: false, message: 'Failed to fetch question' };
    console.error('Error fetching question:', e);
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

onMounted(async () => {
  initAudio();
  fetchQuestion();
  gameStartTime.value = Date.now();
  // Focus input when page loads
  await nextTick();
  answerInput.value?.focus();
});

onBeforeUnmount(() => {
  clearTimer();
});
</script>

<style scoped>
@keyframes gradient-shift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes float-smooth {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  25% { transform: translateY(-10px) rotate(2deg); }
  50% { transform: translateY(-5px) rotate(0deg); }
  75% { transform: translateY(-12px) rotate(-2deg); }
}

.game-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 25%, #FCD34D 50%, #FBBF24 75%, #F59E0B 100%);
  background-size: 400% 400%;
  animation: gradient-shift 15s ease infinite;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
}

.user-menu {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  z-index: 10;
}

.logout-btn {
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  background-color: #EF4444;
  color: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.logout-btn:hover {
  background-color: #DC2626;
  transform: scale(1.05);
}

.auth-links {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.register-btn {
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  background-color: #EAB308;
  color: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.register-btn:hover {
  background-color: #CA8A04;
  transform: scale(1.05);
}

.banana-icon-left {
  position: absolute;
  left: 1.5rem;
  top: 1.5rem;
  font-size: 4rem;
  user-select: none;
  display: inline-block;
  filter: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04)) drop-shadow(0 4px 3px rgba(0, 0, 0, 0.1));
  animation: float-smooth 6s ease-in-out infinite;
}

.banana-icon-right {
  position: absolute;
  right: 1.5rem;
  bottom: 1.5rem;
  font-size: 4rem;
  user-select: none;
  display: inline-block;
  filter: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04)) drop-shadow(0 4px 3px rgba(0, 0, 0, 0.1));
  animation: float-smooth 6s ease-in-out infinite;
}

.game-card {
  background-color: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  border: 1px solid #FED7AA;
  border-radius: 1rem;
  padding: 2rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  width: 100%;
  max-width: 56rem;
  margin-left: 1rem;
  margin-right: 1rem;
  max-height: 90vh;
  overflow-y: auto;
}

.game-card:hover {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  border-color: #FCD34D;
}

.header-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.75rem;
}

.question-title {
  font-size: 1.5rem;
  line-height: 2rem;
  font-weight: 700;
  color: #CA8A04;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.target-icon {
  animation: float-smooth 6s ease-in-out infinite;
}

.level-info {
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: #D97706;
}

.timer {
  text-align: right;
}

.timer-value {
  font-size: 1.875rem;
  line-height: 2.25rem;
  font-weight: 700;
  color: #DC2626;
}

.timer-label {
  font-size: 0.75rem;
  line-height: 1rem;
  color: #F87171;
}

.score-display {
  margin-bottom: 0.75rem;
  padding: 0.5rem;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.score-item {
  text-align: center;
  flex: 1;
}

.score-label {
  font-size: 0.75rem;
  line-height: 1rem;
  color: #6B7280;
}

.score-value {
  font-size: 1.125rem;
  line-height: 1.75rem;
  font-weight: 700;
  color: #CA8A04;
}

.score-value-correct {
  font-size: 1.125rem;
  line-height: 1.75rem;
  font-weight: 700;
  color: #16A34A;
}

.score-value-total {
  font-size: 1.125rem;
  line-height: 1.75rem;
  font-weight: 700;
  color: #2563EB;
}

.question-section {
  display: flex;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
  align-items: stretch;
}

.image-container {
  flex: 1.2;
  display: flex;
  flex-direction: column;
}

.answer-container {
  flex: 0.8;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  justify-content: center;
}

.question-image {
  background-color: #FFFFFF;
  border-radius: 0.75rem;
  padding: 1rem;
  box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.1), inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.question-img {
  max-height: 28rem;
  max-width: 100%;
  border-radius: 0.5rem;
  object-fit: contain;
}

@media (max-width: 768px) {
  .question-section {
    flex-direction: column;
  }

  .question-img {
    max-height: 16rem;
  }
}

.loading {
  background-color: #FFFFFF;
  border-radius: 0.75rem;
  padding: 2rem 1rem;
  box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.1), inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
  text-align: center;
  color: #D97706;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
  min-height: 28rem;
}

.loading-icon {
  animation: spin 1s linear infinite;
  font-size: 1.875rem;
  line-height: 2.25rem;
  margin-bottom: 0.25rem;
}

.loading-text {
  color: #6B7280;
}

.answer-input {
  width: 100%;
  padding: 0.75rem;
  border: 2px solid #FDE047;
  border-radius: 0.5rem;
  text-align: center;
  outline: none;
  font-size: 1.125rem;
  line-height: 1.75rem;
  font-weight: 600;
  background-color: rgba(255, 255, 255, 0.9);
}

.answer-input:focus {
  border-color: #F59E0B;
}

.buttons {
  display: flex;
  gap: 0.5rem;
}

.submit-btn {
  flex: 1;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  background-color: #EAB308;
  color: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 600;
  opacity: 1;
}

.submit-btn:hover {
  background-color: #CA8A04;
  transform: scale(1.05);
}

.submit-btn:disabled {
  opacity: 0.5;
}

.skip-btn {
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  background-color: #F3F4F6;
  color: #374151;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  opacity: 1;
}

.skip-btn:hover {
  background-color: #E5E7EB;
  transform: scale(1.05);
}

.skip-btn:disabled {
  opacity: 0.5;
}

.feedback {
  margin-top: 0.75rem;
  padding: 0.75rem;
  border-radius: 0.5rem;
  text-align: center;
  font-weight: 500;
}

.feedback-success {
  background-color: #DCFCE7;
  color: #166534;
}

.feedback-error {
  background-color: #FEE2E2;
  color: #991B1B;
}

.nav-links {
  margin-top: 1rem;
  display: flex;
  gap: 1rem;
  justify-content: center;
  text-align: center;
}

.back-link {
  color: #CA8A04;
  font-weight: 500;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.back-link:hover {
  color: #B45309;
}

.end-btn {
  color: #DC2626;
  font-weight: 500;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.end-btn:hover {
  color: #B91C1C;
}

.delay-1s {
  animation-delay: 1s;
}
</style>
