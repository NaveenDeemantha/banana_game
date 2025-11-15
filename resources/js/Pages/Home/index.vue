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

    <!-- Floating Decorative Elements -->
    <div class="decor-left">🍌</div>
    <div class="decor-right">🍌</div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="hero-section">
        <div class="hero-icon">🍌</div>
        <h1 class="hero-title">
          Welcome Back, {{ $page.props.auth?.user?.name?.split(' ')[0] || 'Guest' }}!
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

@keyframes shimmer {
  0% { background-position: -1000px 0; }
  100% { background-position: 1000px 0; }
}

@keyframes bounce-in {
  0% { transform: scale(0.9); opacity: 0; }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); opacity: 1; }
}

.home-container {
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
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
  color: #FFFFFF;
  font-weight: 600;
  border-radius: 0.75rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  transition: all 0.3s;
  transform: scale(1);
  font-size: 0.875rem;
}

.admin-btn:hover {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background: linear-gradient(135deg, #D97706 0%, #EA580C 100%);
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
  animation: pulse-subtle 3s ease-in-out infinite;
}

.hero-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1F2937;
  line-height: 1.2;
  margin-bottom: 0.5rem;
  background: linear-gradient(135deg, #D97706 0%, #EA580C 100%);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
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
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 1.5rem;
  box-shadow: 0 8px 16px -4px rgba(251, 191, 36, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border: 2px solid transparent;
  background-clip: padding-box;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  animation: bounce-in 0.6s ease-out;
  position: relative;
}

.card-start::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.4s;
  pointer-events: none;
}

.card-start:hover {
  box-shadow: 0 25px 50px -12px rgba(251, 191, 36, 0.4), 0 20px 25px -5px rgba(251, 146, 60, 0.3);
  transform: translateY(-0.75rem) scale(1.02);
  border-color: rgba(251, 191, 36, 0.3);
}

.card-start:hover::before {
  opacity: 1;
}

.card-leaderboard {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 1.5rem;
  box-shadow: 0 8px 16px -4px rgba(74, 222, 128, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border: 2px solid transparent;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  animation: bounce-in 0.6s ease-out 0.1s both;
  position: relative;
}

.card-leaderboard::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(74, 222, 128, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.4s;
  pointer-events: none;
}

.card-leaderboard:hover {
  box-shadow: 0 25px 50px -12px rgba(74, 222, 128, 0.4), 0 20px 25px -5px rgba(16, 185, 129, 0.3);
  transform: translateY(-0.75rem) scale(1.02);
  border-color: rgba(74, 222, 128, 0.3);
}

.card-leaderboard:hover::before {
  opacity: 1;
}

.card-profile {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 1.5rem;
  box-shadow: 0 8px 16px -4px rgba(96, 165, 250, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border: 2px solid transparent;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  animation: bounce-in 0.6s ease-out 0.2s both;
  position: relative;
}

.card-profile::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(96, 165, 250, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.4s;
  pointer-events: none;
}

.card-profile:hover {
  box-shadow: 0 25px 50px -12px rgba(96, 165, 250, 0.4), 0 20px 25px -5px rgba(59, 130, 246, 0.3);
  transform: translateY(-0.75rem) scale(1.02);
  border-color: rgba(96, 165, 250, 0.3);
}

.card-profile:hover::before {
  opacity: 1;
}

.card-settings {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 1.5rem;
  box-shadow: 0 8px 16px -4px rgba(192, 132, 252, 0.2), 0 4px 8px -2px rgba(0, 0, 0, 0.1);
  border: 2px solid transparent;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  animation: bounce-in 0.6s ease-out 0.3s both;
  position: relative;
}

.card-settings::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(192, 132, 252, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.4s;
  pointer-events: none;
}

.card-settings:hover {
  box-shadow: 0 25px 50px -12px rgba(192, 132, 252, 0.4), 0 20px 25px -5px rgba(168, 85, 247, 0.3);
  transform: translateY(-0.75rem) scale(1.02);
  border-color: rgba(192, 132, 252, 0.3);
}

.card-settings:hover::before {
  opacity: 1;
}

.card-content {
  padding: 1.25rem;
  background: linear-gradient(135deg, #FB923C 0%, #F59E0B 50%, #EA580C 100%);
  color: #FFFFFF;
  min-height: 140px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  overflow: hidden;
}

.card-content::after {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
  transform: rotate(45deg);
  transition: all 0.6s;
}

.card-start:hover .card-content::after {
  right: 100%;
}

.card-leaderboard .card-content {
  background: linear-gradient(135deg, #4ADE80 0%, #22C55E 50%, #16A34A 100%);
}

.card-profile .card-content {
  background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
}

.card-settings .card-content {
  background: linear-gradient(135deg, #C084FC 0%, #A855F7 50%, #9333EA 100%);
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
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
}

.card-start:hover .card-icon {
  transform: scale(1.2) rotate(10deg);
  filter: drop-shadow(0 8px 16px rgba(251, 146, 60, 0.5));
}

.card-leaderboard:hover .card-icon {
  transform: scale(1.2) rotate(-10deg);
  filter: drop-shadow(0 8px 16px rgba(74, 222, 128, 0.5));
}

.card-profile:hover .card-icon {
  transform: scale(1.2) rotate(10deg);
  filter: drop-shadow(0 8px 16px rgba(96, 165, 250, 0.5));
}

.card-settings:hover .card-icon {
  transform: scale(1.2) rotate(-10deg);
  filter: drop-shadow(0 8px 16px rgba(192, 132, 252, 0.5));
}

.card-dot {
  width: 0.75rem;
  height: 0.75rem;
  background-color: rgba(255, 255, 255, 0.5);
  border-radius: 9999px;
  transition: transform 0.3s;
}

.card-start:hover .card-dot,
.card-leaderboard:hover .card-dot,
.card-profile:hover .card-dot,
.card-settings:hover .card-dot {
  transform: scale(1.5);
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
