<template>
  <div class="landing-container">
    <!-- Navigation Bar -->
    <nav class="nav-bar">
      <div class="nav-inner">
        <div class="logo">
          <span class="logo-icon">🍌</span>
          <span class="logo-text">Banana Catcher</span>
        </div>
        <div v-if="$page.props.auth?.user" class="auth-section">
          <Link
            href="/home"
            class="home-btn"
          >
            Home
          </Link>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="logout-btn"
          >
            Logout
          </Link>
        </div>
      </div>
    </nav>

    <!-- Floating Decorative Elements -->
    <div class="decor-left">🍌</div>
    <div class="decor-right">🍌</div>
    <div class="decor-top">🍌</div>
    <div class="decor-bottom">🍌</div>

    <!-- Hero Section -->
    <div class="hero-section">
      <div class="hero-icon-wrapper">
        <div class="hero-icon">🍌</div>
      </div>

      <h1 class="hero-title">
        Banana Catcher
      </h1>

      <p class="hero-subtitle">
        Test your math skills and reflexes! Solve equations before time runs out in this exciting mathematical adventure.
      </p>

      <!-- Feature Cards -->
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">⚡</div>
          <h3 class="feature-title">Fast-Paced</h3>
          <p class="feature-desc">Race against the clock</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎯</div>
          <h3 class="feature-title">Multiple Levels</h3>
          <p class="feature-desc">Easy, Medium, and Hard</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🏆</div>
          <h3 class="feature-title">Compete</h3>
          <p class="feature-desc">Climb the leaderboard</p>
        </div>
      </div>

      <!-- CTA Buttons -->
      <div class="cta-section">
        <Link
          v-if="$page.props.auth?.user"
          href="/difficulty"
          class="start-btn"
        >
          Start Playing
        </Link>
        <template v-else>
          <Link
            :href="route('register')"
            class="register-btn"
          >
            Get Started
          </Link>
          <Link
            :href="route('login')"
            class="login-btn"
          >
            Login
          </Link>
        </template>
        <Link
          href="/leaderboard"
          class="leaderboard-btn"
        >
          View Leaderboard
        </Link>
      </div>
    </div>

    <!-- Bottom Wave Decoration -->
    <div class="wave-decoration">
      <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="wave-svg">
        <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F59E0B"/>
      </svg>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
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

@keyframes pulse-subtle {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.9; transform: scale(1.02); }
}

.landing-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 25%, #FCD34D 50%, #FBBF24 75%, #F59E0B 100%);
  background-size: 400% 400%;
  animation: gradient-shift 15s ease infinite;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  position: relative;
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

.logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.logo-icon {
  font-size: 2.25rem;
  line-height: 2.5rem;
}

.logo-text {
  font-size: 1.5rem;
  line-height: 2rem;
  font-weight: 700;
  color: #1F2937;
}

.auth-section {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.home-btn {
  padding: 0.75rem 1.5rem;
  background-color: #FFFFFF;
  color: #D97706;
  font-weight: 600;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  border: 2px solid #FED7AA;
  transition: all 0.3s;
  transform: scale(1);
}

.home-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background-color: #FFF7ED;
  border-color: #FCD34D;
  transform: scale(1.05);
}

.home-btn:active {
  transform: scale(0.95);
}

.logout-btn {
  padding-left: 0.25rem;
  padding-right: 0.5rem;
  padding-top: 0.25rem;
  padding-bottom: 0.25rem;
  background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
  color: #FFFFFF;
  font-weight: 500;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.3s;
}

.logout-btn:hover {
  background: linear-gradient(135deg, #B91C1C 0%, #991B1B 100%);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.decor-left {
  position: absolute;
  top: 5rem;
  left: 2.5rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
  animation: float-smooth 6s ease-in-out infinite;
}

.decor-right {
  position: absolute;
  bottom: 5rem;
  right: 2.5rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
  animation: float-smooth 6s ease-in-out infinite;
  animation-delay: 1s;
}

.decor-top {
  position: absolute;
  top: 33.333333%;
  right: 4rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
  animation: float-smooth 6s ease-in-out infinite;
  animation-delay: 2s;
}

.decor-bottom {
  position: absolute;
  bottom: 33.333333%;
  left: 4rem;
  font-size: 1.5rem;
  user-select: none;
  display: inline-block;
  opacity: 0.4;
  animation: float-smooth 6s ease-in-out infinite;
  animation-delay: 0.5s;
}

.hero-section {
  max-width: 72rem;
  margin-left: auto;
  margin-right: auto;
  padding-left: 1rem;
  padding-right: 1rem;
  text-align: center;
  z-index: 10;
}

.hero-icon-wrapper {
  margin-bottom: 1rem;
  animation: pulse-subtle 3s ease-in-out infinite;
}

.hero-icon {
  font-size: 2.5rem;
  line-height: 1;
}

.hero-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #1F2937;
  line-height: 1;
  margin-bottom: 1rem;
  background: linear-gradient(135deg, #D97706 0%, #EA580C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
}

.hero-subtitle {
  font-size: 1rem;
  line-height: 1.5rem;
  color: #374151;
  margin-bottom: 1.5rem;
  max-width: 42rem;
  margin-left: auto;
  margin-right: auto;
  font-weight: 500;
}

@media (min-width: 768px) {
  .hero-subtitle {
    font-size: 1.5rem;
    line-height: 2rem;
  }
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(1, minmax(0, 1fr));
  gap: 0.75rem;
  margin-bottom: 1.5rem;
}

@media (min-width: 768px) {
  .features-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

.feature-card {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 0.75rem;
  padding: 1rem;
  box-shadow: 0 4px 12px -2px rgba(251, 191, 36, 0.15), 0 2px 6px -1px rgba(0, 0, 0, 0.08);
  border: 2px solid transparent;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.feature-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(251, 191, 36, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
  opacity: 0;
  transition: opacity 0.4s;
}

.feature-card:hover {
  box-shadow: 0 16px 32px -4px rgba(251, 191, 36, 0.3), 0 8px 16px -2px rgba(245, 158, 11, 0.2);
  transform: translateY(-0.5rem) scale(1.02);
  border-color: rgba(251, 191, 36, 0.3);
}

.feature-card:hover::before {
  opacity: 1;
}

.feature-icon {
  font-size: 1.75rem;
  line-height: 2rem;
  margin-bottom: 0.5rem;
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  display: inline-block;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.feature-card:hover .feature-icon {
  transform: scale(1.2) rotate(5deg);
  filter: drop-shadow(0 8px 16px rgba(251, 191, 36, 0.4));
}

.feature-title {
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 0.25rem;
  font-size: 1rem;
}

.feature-desc {
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: #6B7280;
}

.cta-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  justify-content: center;
  align-items: center;
}

@media (min-width: 640px) {
  .cta-section {
    flex-direction: row;
  }
}

.start-btn {
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 50%, #EA580C 100%);
  color: #FFFFFF;
  font-weight: 700;
  border-radius: 0.75rem;
  box-shadow: 0 8px 16px -4px rgba(251, 191, 36, 0.4), 0 4px 8px -2px rgba(245, 158, 11, 0.3);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  transform: scale(1);
  font-size: 1rem;
  line-height: 1.5rem;
  position: relative;
  overflow: hidden;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.start-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.6s;
}

.start-btn:hover::before {
  left: 100%;
}

.start-btn:hover {
  box-shadow: 0 20px 30px -8px rgba(251, 191, 36, 0.6), 0 8px 16px -4px rgba(245, 158, 11, 0.4);
  background: linear-gradient(135deg, #F59E0B 0%, #EA580C 50%, #DC2626 100%);
  transform: scale(1.08) translateY(-2px);
  border-color: rgba(255, 255, 255, 0.5);
}

.start-btn:active {
  transform: scale(0.98);
  box-shadow: 0 4px 8px -2px rgba(251, 191, 36, 0.3);
}

.register-btn {
  padding: 1rem 2rem;
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
  color: #FFFFFF;
  font-weight: 600;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.3s;
  transform: scale(1);
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.register-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
  transform: scale(1.05);
}

.register-btn:active {
  transform: scale(0.95);
}

.login-btn {
  padding: 1rem 2rem;
  background-color: #FFFFFF;
  color: #D97706;
  font-weight: 600;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  border: 2px solid #FED7AA;
  transition: all 0.3s;
  transform: scale(1);
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.login-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background-color: #FFF7ED;
  border-color: #FCD34D;
  transform: scale(1.05);
}

.login-btn:active {
  transform: scale(0.95);
}

.leaderboard-btn {
  padding: 1rem 2rem;
  background-color: #FFFFFF;
  color: #D97706;
  font-weight: 600;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  border: 2px solid #FED7AA;
  transition: all 0.3s;
  transform: scale(1);
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.leaderboard-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background-color: #FFF7ED;
  border-color: #FCD34D;
  transform: scale(1.05);
}

.leaderboard-btn:active {
  transform: scale(0.95);
}

.wave-decoration {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  opacity: 0.2;
}

.wave-svg {
  width: 100%;
  height: 6rem;
}
</style>
