<template>
  <div class="difficulty-container">
    <!-- Navigation Bar -->
    <nav class="nav-bar">
      <div class="nav-inner">
        <Link href="/home" class="logo-link">
          <span class="logo-icon">🍌</span>
          <span class="logo-text">Banana Catcher</span>
        </Link>
        <Link
          v-if="$page.props.auth?.user"
          :href="route('logout')"
          method="post"
          as="button"
          class="logout-btn"
        >
          Logout
        </Link>
      </div>
    </nav>

    <!-- Floating Decorative Elements -->
    <div class="decor-left">🍌</div>
    <div class="decor-right">🍌</div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="hero-section">
        <div class="hero-icon">🎯</div>
        <h2 class="hero-title">
          Choose Your Challenge
        </h2>
        <p class="hero-subtitle">Select a difficulty level and start playing</p>
      </div>

      <!-- Difficulty Cards -->
      <div class="difficulty-grid">
        <!-- Easy Level -->
        <Link href="/play?level=easy" class="card-easy">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🥥</div>
              <h3 class="card-title">Easy</h3>
            </div>
            <div class="card-details">
              <div class="detail-item">
                <span class="detail-icon">⏱️</span>
                <span class="detail-text">12 seconds per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🍌</span>
                <span class="detail-text">0-3 bananas per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🎯</span>
                <span class="detail-text">Perfect for beginners</span>
              </div>
              <div class="score-info">
                <p class="score-text">Base Score: 10 points + time bonus</p>
              </div>
            </div>
            <button class="start-btn-easy">
              Start Easy Mode
            </button>
          </div>
        </Link>

        <!-- Medium Level -->
        <Link href="/play?level=medium" class="card-medium">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🍍</div>
              <h3 class="card-title">Medium</h3>
            </div>
            <div class="card-details">
              <div class="detail-item">
                <span class="detail-icon">⏱️</span>
                <span class="detail-text">8 seconds per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🍌</span>
                <span class="detail-text">4-6 bananas per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🎯</span>
                <span class="detail-text">Moderate challenge</span>
              </div>
              <div class="score-info">
                <p class="score-text">Base Score: 20 points + time bonus</p>
              </div>
            </div>
            <button class="start-btn-medium">
              Start Medium Mode
            </button>
          </div>
        </Link>

        <!-- Hard Level -->
        <Link href="/play?level=hard" class="card-hard">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🌶️</div>
              <h3 class="card-title">Hard</h3>
            </div>
            <div class="card-details">
              <div class="detail-item">
                <span class="detail-icon">⏱️</span>
                <span class="detail-text">5 seconds per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🍌</span>
                <span class="detail-text">7-10 bananas per question</span>
              </div>
              <div class="detail-item">
                <span class="detail-icon">🎯</span>
                <span class="detail-text">Expert level only</span>
              </div>
              <div class="score-info">
                <p class="score-text">Base Score: 30 points + time bonus</p>
              </div>
            </div>
            <button class="start-btn-hard">
              Start Hard Mode
            </button>
          </div>
        </Link>
      </div>

      <!-- Back Link -->
      <div class="back-section">
        <Link href="/home" class="back-link">
          <span>←</span>
          <span>Back to Home</span>
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useBackgroundMusic } from '@/composables/useBackgroundMusic';

const { initAudio } = useBackgroundMusic();

onMounted(() => {
  initAudio();
});
</script>

<style scoped>
.difficulty-container {
  min-height: 100vh;
  background: #FDE68A;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  padding: 1rem;
}

.nav-bar {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 20;
  padding-left: 1.5rem;
  padding-right: 1.5rem;
  padding-top: 1rem;
  padding-bottom: 1rem;
}

.nav-inner {
  max-width: 80rem;
  margin-left: auto;
  margin-right: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: opacity 0.3s;
}

.logo-link:hover {
  opacity: 0.8;
}

.logo-icon {
  font-size: 1.875rem;
  line-height: 2.25rem;
}

.logo-text {
  font-size: 1.25rem;
  line-height: 1.75rem;
  font-weight: 700;
  color: #1F2937;
}

.logout-btn {
  padding-left: 0.25rem;
  padding-right: 0.5rem;
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  background: #DC2626;
  color: #FFFFFF;
  font-weight: 500;
  border-radius: 0.5rem;
  transition: all 0.3s;
}

.logout-btn:hover {
  background: #B91C1C;
}

.decor-left {
  position: absolute;
  top: 5rem;
  left: 2.5rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
}

.decor-right {
  position: absolute;
  bottom: 5rem;
  right: 2.5rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
}

.main-content {
  max-width: 72rem;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
  z-index: 10;
  margin-top: 3rem;
}

.hero-section {
  margin-bottom: 1.25rem;
}

.hero-icon {
  font-size: 2.5rem;
  line-height: 1;
  margin-bottom: 0.75rem;
}

.hero-title {
  font-size: 2rem;
  font-weight: 700;
  color: #D97706;
  line-height: 1.2;
  margin-bottom: 0.5rem;
}

.hero-subtitle {
  font-size: 1.125rem;
  line-height: 1.75rem;
  color: #374151;
}

.difficulty-grid {
  display: grid;
  grid-template-columns: repeat(1, minmax(0, 1fr));
  gap: 1.5rem;
}

@media (min-width: 768px) {
  .difficulty-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

.card-easy {
  background: #FFFFFF;
  border-radius: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #E5E7EB;
  overflow: hidden;
  transition: all 0.3s;
}

.card-easy:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.25rem);
}

.card-medium {
  background: #FFFFFF;
  border-radius: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #E5E7EB;
  overflow: hidden;
  transition: all 0.3s;
}

.card-medium:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.25rem);
}

.card-hard {
  background: #FFFFFF;
  border-radius: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border: 1px solid #E5E7EB;
  overflow: hidden;
  transition: all 0.3s;
}

.card-hard:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.25rem);
}

.card-content {
  padding: 2rem;
  background: #22C55E;
  color: #FFFFFF;
  min-height: 280px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card-medium .card-content {
  background: #F59E0B;
}

.card-hard .card-content {
  background: #EF4444;
}

.card-header {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card-icon {
  font-size: 3.75rem;
  line-height: 1;
  margin-bottom: 1rem;
  transition: transform 0.3s;
}

.card-easy:hover .card-icon,
.card-medium:hover .card-icon,
.card-hard:hover .card-icon {
  transform: scale(1.1);
}

.card-title {
  font-size: 1.875rem;
  line-height: 2.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
}

.card-details {
  margin-bottom: 1rem;
}

.detail-item {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 0.5rem;
}

.detail-icon {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

.detail-text {
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 500;
}

.score-info {
  margin-top: 1rem;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 0.5rem;
  backdrop-filter: blur(4px);
}

.score-text {
  font-size: 0.75rem;
  line-height: 1rem;
  color: rgba(255, 255, 255, 0.8);
}

.start-btn-easy {
  width: 100%;
  padding: 0.75rem 1.5rem;
  background: #FFFFFF;
  color: #16A34A;
  font-weight: 600;
  border-radius: 1rem;
  transition: background 0.3s;
}

.start-btn-easy:hover {
  background: #F0FDF4;
}

.start-btn-medium {
  width: 100%;
  padding: 0.75rem 1.5rem;
  background: #FFFFFF;
  color: #EA580C;
  font-weight: 600;
  border-radius: 1rem;
  transition: background 0.3s;
}

.start-btn-medium:hover {
  background: #FFF7ED;
}

.start-btn-hard {
  width: 100%;
  padding: 0.75rem 1.5rem;
  background: #FFFFFF;
  color: #DC2626;
  font-weight: 600;
  border-radius: 1rem;
  transition: background 0.3s;
}

.start-btn-hard:hover {
  background: #FEF2F2;
}

.back-section {
  margin-top: 2.5rem;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: #374151;
  font-weight: 500;
  transition: color 0.3s;
}

.back-link:hover {
  color: #111827;
}
</style>
