<template>
  <div class="home-container">
    <!-- Navigation Bar -->
    <nav class="nav-bar">
      <div class="nav-inner">
        <div class="logo">
          <span class="logo-icon">🍌</span>
          <span class="logo-text">Banana Catcher</span>
        </div>
        <div class="auth-section">
          <Link
            v-if="$page.props.auth?.user?.role === 'admin'"
            :href="route('admin.dashboard')"
            class="admin-btn"
          >
            Admin Panel
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
      </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
      <div class="hero-section">
        <div class="hero-icon">🍌</div>
        <h1 class="hero-title">
          Hello, {{ $page.props.auth?.user?.name?.split(' ')[0] || 'Guest' }}!
        </h1>
        <p class="hero-subtitle">
          Ready to test your math skills?
        </p>
      </div>

      <!-- Menu Grid -->
      <div class="menu-grid">
        <!-- Start Game Card -->
        <Link href="/difficulty" class="card-start">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🎮</div>
              <div class="card-dot"></div>
            </div>
            <div class="card-body">
              <h3 class="card-title">Start Game</h3>
              <p class="card-desc">Choose your difficulty and begin the adventure</p>
            </div>
            <div class="card-footer">
              <span class="card-link">Play Now →</span>
            </div>
          </div>
        </Link>

        <!-- Leaderboard Card -->
        <Link href="/leaderboard" class="card-leaderboard">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">🏆</div>
              <div class="card-dot"></div>
            </div>
            <div class="card-body">
              <h3 class="card-title">Leaderboard</h3>
              <p class="card-desc">See who's the top banana catcher</p>
            </div>
            <div class="card-footer">
              <span class="card-link">View Rankings →</span>
            </div>
          </div>
        </Link>

        <!-- Profile Card -->
        <Link href="/profile" class="card-profile">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">👤</div>
              <div class="card-dot"></div>
            </div>
            <div class="card-body">
              <h3 class="card-title">Profile</h3>
              <p class="card-desc">Manage your account and view stats</p>
            </div>
            <div class="card-footer">
              <span class="card-link">Manage →</span>
            </div>
          </div>
        </Link>

        <!-- Settings Card -->
        <Link href="/settings" class="card-settings">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">⚙️</div>
              <div class="card-dot"></div>
            </div>
            <div class="card-body">
              <h3 class="card-title">Settings</h3>
              <p class="card-desc">Customize your game experience</p>
            </div>
            <div class="card-footer">
              <span class="card-link">Configure →</span>
            </div>
          </div>
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
@keyframes float-smooth {
  0% { transform: scale(0.9); opacity: 0; }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); opacity: 1; }
}

.home-container {
  min-height: 100vh;
  background: #fdd534;
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
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
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
  font-size: 1.875rem;
  line-height: 2.25rem;
}

.logo-text {
  font-size: 1.25rem;
  line-height: 1.75rem;
  font-weight: 700;
  color: #1F2937;
}

.auth-section {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.admin-btn {
  padding: 0.5rem 1rem;
  background: #F59E0B;
  color: #FFFFFF;
  font-weight: 600;
  border-radius: 0.75rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.3s;
  font-size: 0.875rem;
}

.admin-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background: #D97706;
  transform: scale(1.05);
}

.admin-btn:active {
  transform: scale(0.95);
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
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.3s;
}

.logout-btn:hover {
  background: #B91C1C;
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
  margin-top: 1.5rem;
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
  font-size: 1rem;
  line-height: 1.5rem;
  color: #374151;
  max-width: 28rem;
  margin-left: auto;
  margin-right: auto;
}

.menu-grid {
  display: grid;
  grid-template-columns: repeat(1, minmax(0, 1fr));
  gap: 0.75rem;
  max-width: 56rem;
  margin-left: auto;
  margin-right: auto;
}

@media (min-width: 768px) {
  .menu-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

.card-start {
  background: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  /* border: 2px solid transparent; */
  overflow: hidden;
  transition: all 0.3s;
  position: relative;
}

.card-start:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.5rem);
}

.card-leaderboard {
  background: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  /* border: 2px solid transparent; */
  overflow: hidden;
  transition: all 0.3s;
  position: relative;
}

.card-leaderboard:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.5rem);
}

.card-profile {
  background: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  /* border: 2px solid transparent; */
  overflow: hidden;
  transition: all 0.3s;
  position: relative;
}

.card-profile:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.5rem);
}

.card-settings {
  background: #FFFFFF;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  /* border: 2px solid transparent; */
  overflow: hidden;
  transition: all 0.3s;
  position: relative;
}

.card-settings:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-0.5rem);
}

.card-content {
  padding: 2rem;
  background: #F59E0B;
  color: #FFFFFF;
  min-height: 140px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
}

.card-leaderboard .card-content {
  background: #22C55E;
}

.card-profile .card-content {
  background: #3B82F6;
}

.card-settings .card-content {
  background: #A855F7;
}

.card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}

.card-icon {
  font-size: 2rem;
  line-height: 1;
  transition: transform 0.3s;
}

.card-start:hover .card-icon,
.card-leaderboard:hover .card-icon,
.card-profile:hover .card-icon,
.card-settings:hover .card-icon {
  transform: scale(1.1);
}

.card-dot {
  width: 0.75rem;
  height: 0.75rem;
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: 9999px;
}

.card-body {
  text-align: left;
}

.card-title {
  font-size: 1.125rem;
  line-height: 1.5rem;
  font-weight: 700;
  margin-bottom: 0.25rem;
}

.card-desc {
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.8125rem;
  line-height: 1.125rem;
}

.card-footer {
  text-align: right;
  margin-top: 0.5rem;
}

.card-link {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 500;
  transition: color 0.3s;
}

.card-start:hover .card-link,
.card-leaderboard:hover .card-link,
.card-profile:hover .card-link,
.card-settings:hover .card-link {
  color: #FFFFFF;
}
</style>
