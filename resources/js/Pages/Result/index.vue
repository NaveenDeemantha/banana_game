<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

// Receive props from the server
const props = defineProps({
  gameResults: {
    type: Object,
    default: () => ({
      score: 0,
      totalQuestions: 0,
      correctAnswers: 0,
      difficulty: 'Medium',
      timeBonus: 0,
      accuracy: 0,
      newRecord: false
    })
  }
});

const showAnimation = ref(false);

onMounted(() => {
  setTimeout(() => {
    showAnimation.value = true;
  }, 300);
});

function getScoreColor(score) {
  if (score >= 90) return 'score-excellent';
  if (score >= 70) return 'score-good';
  return 'score-average';
}

function getPerformanceMessage(score) {
  if (score >= 90) return 'Outstanding! 🌟';
  if (score >= 70) return 'Great Job! 🎉';
  if (score >= 50) return 'Good Effort! 👏';
  return 'Keep Practicing! 💪';
}

// Use props.gameResults instead of gameResults.value in template
</script>

<template>
  <div class="result-container">
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
        <Link
          href="/login"
          class="login-btn"
        >
          🔑 Login
        </Link>
        <Link
          href="/register"
          class="register-btn"
        >
          ✨ Register
        </Link>
      </div>
    </div>

    <div class="banana-left">🍌</div>
    <div class="banana-right">🍌</div>

    <div class="result-card">
      <div class="title-section">
        <div class="celebration-icon">🎉</div>
        <h2 class="performance-title">{{ getPerformanceMessage(props.gameResults.score) }}</h2>
        <p class="subtitle">Your banana catching session is complete!</p>
      </div>

      <!-- Score Display -->
      <div class="score-display">
        <div class="score-circle" :class="showAnimation ? 'score-animated' : ''">
          <div class="score-number" :class="getScoreColor(props.gameResults.score)">
            {{ props.gameResults.score }}
          </div>
        </div>
        <div class="score-label">Final Score</div>
      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-value stat-correct">{{ props.gameResults.correctAnswers }}</div>
          <div class="stat-label">Correct</div>
        </div>
        <div class="stat-card">
          <div class="stat-value stat-total">{{ props.gameResults.totalQuestions }}</div>
          <div class="stat-label">Total</div>
        </div>
        <div class="stat-card">
          <div class="stat-value stat-accuracy">{{ props.gameResults.accuracy }}%</div>
          <div class="stat-label">Accuracy</div>
        </div>
        <div class="stat-card">
          <div class="stat-value stat-bonus">+{{ props.gameResults.timeBonus }}</div>
          <div class="stat-label">Time Bonus</div>
        </div>
      </div>

      <!-- Achievement Badges -->
      <div class="achievements-section">
        <h3 class="achievements-title">Achievements Unlocked</h3>
        <div class="achievements-list">
          <div v-if="props.gameResults.correctAnswers >= 10" class="achievement-badge">
            <div class="badge-icon">🏅</div>
            <div class="badge-text">Speed Demon</div>
          </div>
          <div v-if="props.gameResults.accuracy >= 80" class="achievement-badge achievement-shooter">
            <div class="badge-icon">🎯</div>
            <div class="badge-text">Sharp Shooter</div>
          </div>
          <div v-if="props.gameResults.score >= 80" class="achievement-badge achievement-scorer">
            <div class="badge-icon">⭐</div>
            <div class="badge-text">High Scorer</div>
          </div>
        </div>
      </div>

      <!-- Record Notice -->
      <div v-if="props.gameResults.newRecord" class="record-notice">
        <div class="record-icon">🏆</div>
        <div class="record-title">New Personal Record!</div>
        <div class="record-text">You've beaten your previous best score!</div>
      </div>

      <!-- Action Buttons -->
      <div class="action-buttons">
        <Link href="/play" class="action-btn play-btn">
          <span class="btn-icon">🔁</span>
          Play Again
        </Link>
        <Link href="/leaderboard" class="action-btn leaderboard-btn">
          <span class="btn-icon">🏆</span>
          Leaderboard
        </Link>
        <Link href="/home" class="action-btn home-btn">
          <span class="btn-icon">🏠</span>
          Home
        </Link>
      </div>

      <!-- Share Section -->
      <div class="share-section">
        <div class="share-text">Share your achievement!</div>
        <div class="share-buttons">
          <button class="share-btn share-mobile">📱</button>
          <button class="share-btn share-chat">💬</button>
          <button class="share-btn share-email">📧</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Keyframes */
@keyframes float-y {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

@keyframes bounce {
  0%, 20%, 53%, 80%, 100% { transform: translate3d(0, 0, 0); }
  40%, 43% { transform: translate3d(0, -30px, 0); }
  70% { transform: translate3d(0, -15px, 0); }
  90% { transform: translate3d(0, -4px, 0); }
}

@keyframes gradient-shift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes bounce-in {
  0% { transform: scale(0.9); opacity: 0; }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); opacity: 1; }
}

@keyframes pulse-subtle {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.9; transform: scale(1.05); }
}

/* Main container */
.result-container {
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
}

/* User menu */
.user-menu {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  z-index: 10;
}

.logout-btn {
  padding: 0.5rem 1rem;
  background-color: #ef4444;
  color: white;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.logout-btn:hover {
  background-color: #dc2626;
  transform: scale(1.05);
}

.auth-links {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.login-btn {
  padding: 0.5rem 1rem;
  background-color: white;
  color: #a16207;
  border: 2px solid #fbbf24;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.login-btn:hover {
  background-color: #fefce8;
  transform: scale(1.05);
}

.register-btn {
  padding: 0.5rem 1rem;
  background-color: #eab308;
  color: white;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.register-btn:hover {
  background-color: #ca8a04;
  transform: scale(1.05);
}

/* Banana decorations */
.banana-left {
  position: absolute;
  left: 1.5rem;
  top: 1.5rem;
  font-size: 4rem;
  animation: float-y 3s ease-in-out infinite;
  user-select: none;
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

.banana-right {
  position: absolute;
  right: 1.5rem;
  bottom: 1.5rem;
  font-size: 4rem;
  animation: float-y 3s ease-in-out infinite;
  animation-delay: 1s;
  user-select: none;
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

/* Result card */
.result-card {
  background-color: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  border: 1px solid #fed7aa;
  border-radius: 1rem;
  padding: 1rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  width: 100%;
  max-width: 42rem;
  margin: 1rem;
}

.result-card:hover {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  border-color: #fdba74;
}

/* Title section */
.title-section {
  text-align: center;
  margin-bottom: 1rem;
}

.celebration-icon {
  font-size: 3.5rem;
  margin-bottom: 0.5rem;
  animation: float-y 3s ease-in-out infinite, pulse-subtle 2s ease-in-out infinite;
  filter: drop-shadow(0 10px 25px rgba(251, 191, 36, 0.5));
}

.performance-title {
  font-size: 1.5rem;
  font-weight: 800;
  color: #a16207;
  margin-bottom: 0.25rem;
}

.subtitle {
  color: #d97706;
}

/* Score display */
.score-display {
  text-align: center;
  margin-bottom: 1rem;
}

.score-circle {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 8rem;
  height: 8rem;
  border-radius: 50%;
  background-color: white;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  margin-bottom: 0.5rem;
}

.score-animated {
  animation: bounce 1s;
}

.score-number {
  font-size: 2.25rem;
  font-weight: bold;
}

.score-excellent {
  color: #16a34a;
}

.score-good {
  color: #d97706;
}

.score-average {
  color: #ea580c;
}

.score-label {
  font-size: 1.125rem;
  color: #a16207;
  font-weight: 600;
}

/* Stats grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.5rem;
  margin-bottom: 1rem;
}

@media (min-width: 768px) {
  .stats-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

.stat-card {
  background-color: rgba(255, 255, 255, 0.7);
  border-radius: 0.75rem;
  padding: 0.625rem;
  text-align: center;
}

.stat-value {
  font-size: 1.25rem;
  font-weight: bold;
}

.stat-correct {
  color: #2563eb;
}

.stat-total {
  color: #9333ea;
}

.stat-accuracy {
  color: #16a34a;
}

.stat-bonus {
  color: #ea580c;
}

.stat-label {
  font-size: 0.875rem;
  color: #6b7280;
}

/* Achievements section */
.achievements-section {
  margin-bottom: 1rem;
}

.achievements-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: #a16207;
  margin-bottom: 0.5rem;
  text-align: center;
}

.achievements-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 0.5rem;
}

.achievement-badge {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border-radius: 0.5rem;
  padding: 0.5rem;
  text-align: center;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid rgba(251, 191, 36, 0.3);
  box-shadow: 0 4px 8px -2px rgba(251, 191, 36, 0.3);
  animation: bounce-in 0.6s ease-out;
}

.achievement-badge:hover {
  transform: scale(1.1) rotate(3deg);
  box-shadow: 0 12px 24px -4px rgba(251, 191, 36, 0.5);
}

.achievement-shooter {
  background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
  border-color: rgba(74, 222, 128, 0.3);
  box-shadow: 0 4px 8px -2px rgba(74, 222, 128, 0.3);
}

.achievement-shooter:hover {
  box-shadow: 0 12px 24px -4px rgba(74, 222, 128, 0.5);
}

.achievement-scorer {
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
  border-color: rgba(96, 165, 250, 0.3);
  box-shadow: 0 4px 8px -2px rgba(96, 165, 250, 0.3);
}

.achievement-scorer:hover {
  box-shadow: 0 12px 24px -4px rgba(96, 165, 250, 0.5);
}

.badge-icon {
  font-size: 1.5rem;
  margin-bottom: 0.25rem;
}

.badge-text {
  font-size: 0.75rem;
  font-weight: 500;
  color: #92400e;
}

.achievement-shooter .badge-text {
  color: #166534;
}

.achievement-scorer .badge-text {
  color: #1e40af;
}

/* Record notice */
.record-notice {
  background: linear-gradient(to right, #fbbf24, #fb923c);
  border-radius: 0.75rem;
  padding: 0.75rem;
  margin-bottom: 1rem;
  text-align: center;
  color: white;
}

.record-icon {
  font-size: 1.5rem;
  margin-bottom: 0.25rem;
}

.record-title {
  font-weight: bold;
}

.record-text {
  font-size: 0.875rem;
}

/* Action buttons */
.action-buttons {
  display: grid;
  grid-template-columns: 1fr;
  gap: 0.5rem;
}

@media (min-width: 640px) {
  .action-buttons {
    grid-template-columns: repeat(3, 1fr);
  }
}

.action-btn {
  padding: 0.625rem 1rem;
  text-align: center;
  font-weight: 600;
  border-radius: 0.75rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.375rem;
}

.action-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.play-btn {
  background-color: #eab308;
  color: white;
}

.play-btn:hover {
  background-color: #ca8a04;
}

.leaderboard-btn {
  background-color: #22c55e;
  color: white;
}

.leaderboard-btn:hover {
  background-color: #16a34a;
}

.home-btn {
  background-color: #3b82f6;
  color: white;
}

.home-btn:hover {
  background-color: #2563eb;
}

.btn-icon {
  font-size: 1.25rem;
  margin-right: 0.5rem;
}

/* Share section */
.share-section {
  margin-top: 1rem;
  text-align: center;
}

.share-text {
  font-size: 0.875rem;
  color: #a16207;
  margin-bottom: 0.5rem;
}

.share-buttons {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

.share-btn {
  width: 2rem;
  height: 2rem;
  border-radius: 50%;
  color: white;
  transition: transform 0.2s;
  font-size: 0.875rem;
}

.share-btn:hover {
  transform: scale(1.1);
}

.share-mobile {
  background-color: #3b82f6;
}

.share-chat {
  background-color: #22c55e;
}

.share-email {
  background-color: #9333ea;
}
</style>
