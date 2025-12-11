
<template>
  <div class="settings-container">
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

    <!-- Enhanced floating decorations -->
    <div class="decoration-left">🍌</div>
    <div class="decoration-right">🍌</div>
    <div class="decoration-top">⚙️</div>
    <div class="decoration-bottom">🎮</div>

    <div class="content-wrapper">
      <!-- Header Section -->
      <div class="header-section">
        <div class="settings-icon">⚙️</div>
        <h1 class="settings-title">Game Settings</h1>
        <p class="settings-subtitle">
          Customize your banana catching experience to perfection
        </p>
      </div>

      <!-- Settings Container -->
      <div class="settings-wrapper">
        <div class="settings-card">

          <!-- Game Preferences Section -->
          <div class="preferences-section">
            <div class="section-header">
              <h3 class="section-title">
                <span>🎮</span>
                Game Preferences
              </h3>
              <p class="section-description">Configure your gameplay experience</p>
            </div>

            <div class="preferences-grid">
              <!-- Background Music Setting -->
              <div class="setting-card music-card">
                <div class="setting-content">
                  <div class="setting-info">
                    <span class="setting-icon">🎵</span>
                    <div>
                      <div class="setting-name">Background Music</div>
                      <div class="setting-desc">Play relaxing background music</div>
                    </div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="settings.backgroundMusic" class="toggle-input">
                    <div class="toggle-slider" :class="settings.backgroundMusic ? 'toggle-on' : 'toggle-off'"></div>
                  </label>
                </div>
                <!-- Volume Slider -->
                <div v-if="settings.backgroundMusic" class="volume-control">
                  <label class="volume-label">
                    <span class="volume-icon">🔊</span>
                    <span class="volume-text">Volume: {{ Math.round(settings.musicVolume) }}%</span>
                  </label>
                  <input
                    type="range"
                    v-model="settings.musicVolume"
                    min="0"
                    max="100"
                    step="1"
                    class="volume-slider"
                  >
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="action-buttons">
            <Link href="/home" class="home-btn">
              🏠 Back to Home
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import { useBackgroundMusic } from '@/composables/useBackgroundMusic';

const { isMusicEnabled, volume, setMusicEnabled, setVolume, initAudio } = useBackgroundMusic();

const settings = ref({
  backgroundMusic: isMusicEnabled.value,
  musicVolume: volume.value * 100 // Convert to 0-100 scale
});

// Watch for music setting changes
watch(() => settings.value.backgroundMusic, (newValue) => {
  setMusicEnabled(newValue);
});

watch(() => settings.value.musicVolume, (newValue) => {
  setVolume(newValue / 100); // Convert back to 0-1 scale
});

onMounted(() => {
  initAudio();
  settings.value.backgroundMusic = isMusicEnabled.value;
  settings.value.musicVolume = volume.value * 100;
});
</script>

<style scoped>
/* Main container */
.settings-container {
  min-height: 100vh;
  background: #FDE68A;
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
  transition: background 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.logout-btn:hover {
  background-color: #dc2626;
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
  transition: background 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.login-btn:hover {
  background-color: #fefce8;
}

.register-btn {
  padding: 0.5rem 1rem;
  background-color: #eab308;
  color: white;
  border-radius: 0.5rem;
  transition: background 0.3s;
  font-weight: 500;
  font-size: 0.875rem;
}

.register-btn:hover {
  background-color: #ca8a04;
}

/* Floating decorations */
.decoration-left {
  position: absolute;
  left: 1.5rem;
  top: 1.5rem;
  font-size: 4rem;
  opacity: 0.4;
}

.decoration-right {
  position: absolute;
  right: 1.5rem;
  bottom: 1.5rem;
  font-size: 4rem;
  opacity: 0.4;
}

.decoration-top {
  position: absolute;
  top: 25%;
  right: 3rem;
  font-size: 4rem;
  opacity: 0.4;
}

.decoration-bottom {
  position: absolute;
  bottom: 25%;
  left: 3rem;
  font-size: 4rem;
  opacity: 0.4;
}

/* Content wrapper */
.content-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 1.5rem 0;
}

/* Header section */
.header-section {
  text-align: center;
  margin-bottom: 1rem;
}

.settings-icon {
  font-size: 3.5rem;
  margin-bottom: 0.75rem;
}

.settings-title {
  font-size: 1.75rem;
  font-weight: bold;
  color: #92400e;
  margin-bottom: 0.5rem;
}

.settings-subtitle {
  font-size: 1.25rem;
  color: #a16207;
  max-width: 28rem;
  margin: 0 auto;
}

/* Settings wrapper */
.settings-wrapper {
  width: 100%;
  max-width: 56rem;
  margin: 0 1rem;
}

.settings-card {
  background-color: white;
  border-radius: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

/* Section headers */
.section-header {
  border-bottom: 2px solid #fed7aa;
  padding-bottom: 0.5rem;
}

.section-title {
  font-size: 1.25rem;
  font-weight: bold;
  color: #a16207;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.section-description {
  color: #d97706;
  font-size: 0.875rem;
}

/* Preferences section */
.preferences-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.preferences-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1rem;
}

@media (min-width: 768px) {
  .preferences-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

.setting-card {
  background: #FFFFFF;
  border-radius: 0.75rem;
  padding: 1rem;
  border: 2px solid #E5E7EB;
  transition: border-color 0.3s;
}

.setting-card:hover {
  border-color: #fbbf24;
}

.music-card {
  grid-column: 1 / -1;
}

.setting-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.setting-info {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.setting-icon {
  font-size: 1.875rem;
}

.setting-name {
  font-weight: 600;
  color: #1f2937;
}

.setting-desc {
  font-size: 0.875rem;
  color: #6b7280;
}

/* Toggle switches */
.toggle-switch {
  position: relative;
  display: inline-block;
  width: 3.5rem;
  height: 2rem;
  cursor: pointer;
}

.toggle-input {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle-slider {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #d1d5db;
  border-radius: 9999px;
  transition: all 0.3s;
}

.toggle-slider:before {
  position: absolute;
  content: "";
  height: 1.5rem;
  width: 1.5rem;
  left: 0.25rem;
  bottom: 0.25rem;
  background-color: white;
  border-radius: 50%;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  transition: all 0.3s;
}

.toggle-on {
  background: #EAB308;
}

.toggle-on:before {
  transform: translateX(1.5rem);
}

/* Volume Control */
.volume-control {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #fed7aa;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.volume-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #92400e;
  font-weight: 500;
}

.volume-icon {
  font-size: 1.25rem;
}

.volume-text {
  font-weight: 600;
}

.volume-slider {
  width: 100%;
  height: 0.5rem;
  border-radius: 0.25rem;
  background: #FBBF24;
  outline: none;
  appearance: none;
  cursor: pointer;
}

.volume-slider::-webkit-slider-thumb {
  appearance: none;
  width: 1.25rem;
  height: 1.25rem;
  border-radius: 50%;
  background: #F59E0B;
  cursor: pointer;
}

.volume-slider::-webkit-slider-thumb:hover {
  background: #EA580C;
}

.volume-slider::-moz-range-thumb {
  width: 1.25rem;
  height: 1.25rem;
  border-radius: 50%;
  background: #F59E0B;
  cursor: pointer;
  border: none;
}

.volume-slider::-moz-range-thumb:hover {
  background: #EA580C;
}

/* Theme section (removed) */
.theme-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.theme-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}

@media (min-width: 768px) {
  .theme-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

.theme-btn {
  background: #FFFFFF;
  border-radius: 0.75rem;
  padding: 1rem;
  border: 2px solid;
  transition: border-color 0.3s;
  text-align: center;
}

.theme-selected {
  border-color: #eab308;
}

.theme-unselected {
  border-color: #e5e7eb;
}

.theme-unselected:hover {
  border-color: #fbbf24;
}

.theme-preview {
  font-size: 1.875rem;
  margin-bottom: 0.5rem;
}

.theme-name {
  font-weight: 500;
  color: #1f2937;
}

.theme-colors {
  display: flex;
  gap: 0.25rem;
  margin-top: 0.5rem;
  justify-content: center;
}

.color-dot {
  width: 0.75rem;
  height: 0.75rem;
  border-radius: 50%;
}

/* Language section */
.language-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.language-select-wrapper {
  position: relative;
}

.language-select {
  width: 100%;
  padding: 0.75rem 1rem;
  background: #FFFFFF;
  border: 2px solid #E5E7EB;
  border-radius: 0.75rem;
  color: #1f2937;
  font-weight: 500;
  outline: none;
  cursor: pointer;
  appearance: none;
  transition: border-color 0.3s;
}

.language-select:focus {
  border-color: #fbbf24;
}

.select-arrow {
  position: absolute;
  right: 1rem;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
  color: #d97706;
}

/* Action buttons */
.action-buttons {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  padding-top: 1.5rem;
}

@media (min-width: 640px) {
  .action-buttons {
    flex-direction: row;
  }
}

.home-btn {
  flex: 1;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: bold;
  font-size: 1.125rem;
  transition: background 0.3s;
  background-color: white;
  color: #a16207;
  border: 2px solid #fbbf24;
  text-align: center;
}

.home-btn:hover {
  background-color: #fefce8;
}
</style>
