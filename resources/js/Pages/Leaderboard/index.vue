<template>
  <div class="leaderboard-container">
    <!-- User Menu in Top Right -->
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

    <div class="leaderboard-card">
      <div class="title-section">
        <div class="trophy-icon">🏆</div>
        <h2 class="leaderboard-title">Leaderboard</h2>
        <p class="leaderboard-subtitle">Top banana catchers of all time!</p>
      </div>

      <!-- Difficulty Filter -->
      <div class="difficulty-filter">
        <button
          v-for="diff in difficulties"
          :key="diff.value"
          @click="selectedDifficulty = diff.value; fetchLeaderboard()"
          class="difficulty-btn"
          :class="selectedDifficulty === diff.value ? 'difficulty-btn-selected' : 'difficulty-btn-unselected'"
        >
          {{ diff.icon }} {{ diff.label }}
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="loading-section">
        <div class="loading-icon">🍌</div>
        <p class="loading-text">Loading leaderboard...</p>
      </div>

      <!-- Leaderboard List -->
      <div v-else-if="players.length > 0" class="leaderboard-list">
        <div v-for="(player, i) in players" :key="i"
             class="player-row"
             :class="getRowClass(i, player.user_id)"
        >
          <div class="player-info">
            <div class="rank-badge" :class="getRankClass(i)">
              {{ i + 1 }}
            </div>
            <div class="player-avatar">{{ getAvatar(i) }}</div>
            <div class="player-details">
              <div class="player-name">
                {{ player.name }}
                <span v-if="isCurrentUser(player.user_id)" class="you-badge">You</span>
              </div>
              <div class="player-stats">
                {{ player.correct_answers || 0 }} correct answers
              </div>
            </div>
          </div>
          <div class="score-section">
            <div class="score-value">{{ player.score }}</div>
            <div class="score-label">🍌 points</div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="empty-state">
        <div class="empty-icon">🎮</div>
        <p class="empty-text">No scores yet for this difficulty!</p>
        <p class="empty-subtext">Be the first to play and set a record!</p>
      </div>

      <!-- User's Stats (if authenticated) -->
      <div v-if="userStats && $page.props.auth?.user" class="user-stats">
        <div class="stats-icon">🎯</div>
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-label">Your Best</div>
            <div class="stat-value">{{ userStats.best_score || 0 }}</div>
          </div>
          <div class="stat-item">
            <div class="stat-label">Games Played</div>
            <div class="stat-value">{{ userStats.total_games || 0 }}</div>
          </div>
          <div class="stat-item">
            <div class="stat-label">Avg Score</div>
            <div class="stat-value">{{ userStats.average_score || 0 }}</div>
          </div>
        </div>
      </div>

      <div class="action-buttons">
        <Link href="/play" class="play-btn">
          🎮 Play Again
        </Link>
        <Link href="/home" class="home-btn">
          🏠 Back to Home
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const page = usePage();
const players = ref([]);
const userStats = ref(null);
const loading = ref(true);
const selectedDifficulty = ref(null);

const difficulties = [
  { value: null, label: 'All', icon: '🌟' },
  { value: 'easy', label: 'Easy', icon: '🥥' },
  { value: 'medium', label: 'Medium', icon: '🍍' },
  { value: 'hard', label: 'Hard', icon: '🌶️' }
];

const avatars = ['🦸‍♂️', '🧠', '⭐', '🎯', '🚀', '💎', '🔥', '⚡', '🌟', '🎨'];

function getAvatar(index) {
  return avatars[index % avatars.length];
}

function getRankClass(index) {
  if (index === 0) return 'rank-gold';
  if (index === 1) return 'rank-silver';
  if (index === 2) return 'rank-bronze';
  return 'rank-default';
}

function getRowClass(index, userId) {
  let classes = '';
  if (index === 0) classes += ' first-place';
  if (isCurrentUser(userId)) classes += ' current-user';
  return classes.trim();
}

function isCurrentUser(userId) {
  return page.props.auth?.user?.id === userId;
}

async function fetchLeaderboard() {
  loading.value = true;
  try {
    const params = new URLSearchParams();
    if (selectedDifficulty.value) {
      params.append('difficulty', selectedDifficulty.value);
    }
    params.append('limit', '10');

    const response = await axios.get(`/api/leaderboard?${params.toString()}`);

    if (response.data.success) {
      players.value = response.data.data;
    }
  } catch (error) {
    console.error('Failed to fetch leaderboard:', error);
  } finally {
    loading.value = false;
  }
}

async function fetchUserStats() {
  if (!page.props.auth?.user) return;

  try {
    const response = await axios.get('/api/scores/history');

    if (response.data.success) {
      userStats.value = response.data.stats;
    }
  } catch (error) {
    console.error('Failed to fetch user stats:', error);
  }
}

onMounted(() => {
  fetchLeaderboard();
  fetchUserStats();
});
</script>

<style scoped>
/* Keyframes */
@keyframes float-y {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes gradient-shift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes pulse-subtle {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.95; }
}

/* Main container */
.leaderboard-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 25%, #FCD34D 50%, #FBBF24 75%, #F59E0B 100%);
  background-size: 400% 400%;
  animation: gradient-shift 15s ease infinite;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 1rem;
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

/* Leaderboard card */
.leaderboard-card {
  background-color: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  border: 1px solid #fed7aa;
  border-radius: 1rem;
  padding: 1.25rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  width: 100%;
  max-width: 42rem;
}

.leaderboard-card:hover {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  border-color: #fdba74;
}

/* Title section */
.title-section {
  text-align: center;
  margin-bottom: 1rem;
}

.trophy-icon {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
  animation: float-y 3s ease-in-out infinite;
}

.leaderboard-title {
  font-size: 1.75rem;
  font-weight: 800;
  color: #92400e;
  margin-bottom: 0.25rem;
}

.leaderboard-subtitle {
  color: rgba(161, 98, 7, 0.8);
}

/* Difficulty filter */
.difficulty-filter {
  margin-bottom: 1rem;
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  flex-wrap: wrap;
}

.difficulty-btn {
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  font-weight: 500;
  transition: all 0.3s;
}

.difficulty-btn-selected {
  background-color: #eab308;
  color: white;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.difficulty-btn-unselected {
  background-color: white;
  color: #a16207;
}

.difficulty-btn-unselected:hover {
  background-color: #fef3c7;
}

/* Loading section */
.loading-section {
  text-align: center;
  padding: 1.5rem 0;
}

.loading-icon {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
  animation: spin 1s linear infinite;
}

.loading-text {
  color: #a16207;
}

/* Leaderboard list */
.leaderboard-list {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.player-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(254, 252, 232, 0.9) 100%);
  border-radius: 0.75rem;
  box-shadow: 0 2px 8px -2px rgba(0, 0, 0, 0.1), 0 1px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid transparent;
}

.player-row:hover {
  box-shadow: 0 8px 24px -4px rgba(251, 191, 36, 0.3), 0 4px 12px -2px rgba(0, 0, 0, 0.1);
  transform: translateX(8px) scale(1.02);
  border-color: rgba(251, 191, 36, 0.3);
  background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(254, 243, 199, 1) 100%);
}

.first-place {
  box-shadow: 0 0 0 3px #fbbf24, 0 0 20px rgba(251, 191, 36, 0.5), 0 8px 24px -4px rgba(251, 191, 36, 0.4);
  background: linear-gradient(135deg, #fefce8 0%, #fef3c7 50%, #fde68a 100%);
  animation: pulse-subtle 3s ease-in-out infinite;
}

.first-place:hover {
  box-shadow: 0 0 0 3px #fbbf24, 0 0 30px rgba(251, 191, 36, 0.7), 0 12px 32px -4px rgba(251, 191, 36, 0.5);
}

.current-user {
  box-shadow: 0 0 0 2px #60a5fa;
  background-color: #eff6ff;
}

.player-info {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.rank-badge {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  font-weight: bold;
  color: white;
  font-size: 1.125rem;
}

.rank-gold {
  background-color: #eab308;
}

.rank-silver {
  background-color: #9ca3af;
}

.rank-bronze {
  background-color: #fb923c;
}

.rank-default {
  background-color: #3b82f6;
}

.player-avatar {
  font-size: 2.25rem;
}

.player-details {
  display: flex;
  flex-direction: column;
}

.player-name {
  font-weight: bold;
  color: #1f2937;
  font-size: 1.125rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.you-badge {
  font-size: 0.75rem;
  background-color: #3b82f6;
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 9999px;
}

.player-stats {
  font-size: 0.875rem;
  color: #6b7280;
}

.score-section {
  text-align: right;
}

.score-value {
  font-weight: bold;
  color: #a16207;
  font-size: 1.25rem;
}

.score-label {
  font-size: 0.875rem;
  color: #d97706;
}

/* Empty state */
.empty-state {
  text-align: center;
  padding: 3rem 0;
}

.empty-icon {
  font-size: 4rem;
  margin-bottom: 1rem;
}

.empty-text {
  color: #a16207;
  margin-bottom: 1rem;
}

.empty-subtext {
  color: #d97706;
  font-size: 0.875rem;
}

/* User stats */
.user-stats {
  margin-top: 2rem;
  background-color: rgba(254, 240, 138, 0.5);
  border-radius: 0.5rem;
  padding: 1rem;
}

.stats-icon {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  text-align: center;
}

.stat-label {
  font-size: 0.875rem;
  font-weight: 500;
  color: #92400e;
}

.stat-value {
  font-size: 1.25rem;
  font-weight: bold;
  color: #a16207;
}

/* Action buttons */
.action-buttons {
  margin-top: 2rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  justify-content: center;
}

@media (min-width: 640px) {
  .action-buttons {
    flex-direction: row;
  }
}

.play-btn {
  padding: 0.75rem 1.5rem;
  background-color: #eab308;
  color: white;
  border-radius: 0.75rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 600;
  text-align: center;
}

.play-btn:hover {
  background-color: #ca8a04;
  transform: scale(1.05);
}

.home-btn {
  padding: 0.75rem 1.5rem;
  background-color: white;
  color: #a16207;
  border: 2px solid #fbbf24;
  border-radius: 0.75rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  font-weight: 600;
  text-align: center;
}

.home-btn:hover {
  background-color: #fefce8;
  transform: scale(1.05);
}
</style>
