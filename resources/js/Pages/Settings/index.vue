
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

              <!-- Sound Effects Setting -->
              <div class="setting-card">
                <div class="setting-content">
                  <div class="setting-info">
                    <span class="setting-icon">🔔</span>
                    <div>
                      <div class="setting-name">Sound Effects</div>
                      <div class="setting-desc">Enable game sound effects</div>
                    </div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="settings.sound" class="toggle-input">
                    <div class="toggle-slider" :class="settings.sound ? 'toggle-on' : 'toggle-off'"></div>
                  </label>
                </div>
              </div>

              <!-- Auto Submit Setting -->
              <div class="setting-card">
                <div class="setting-content">
                  <div class="setting-info">
                    <span class="setting-icon">⚡</span>
                    <div>
                      <div class="setting-name">Auto Submit</div>
                      <div class="setting-desc">Submit answers automatically</div>
                    </div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="settings.autoSubmit" class="toggle-input">
                    <div class="toggle-slider" :class="settings.autoSubmit ? 'toggle-on' : 'toggle-off'"></div>
                  </label>
                </div>
              </div>

              <!-- Notifications Setting -->
              <div class="setting-card">
                <div class="setting-content">
                  <div class="setting-info">
                    <span class="setting-icon">📢</span>
                    <div>
                      <div class="setting-name">Notifications</div>
                      <div class="setting-desc">Get achievement alerts</div>
                    </div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="settings.notifications" class="toggle-input">
                    <div class="toggle-slider" :class="settings.notifications ? 'toggle-on' : 'toggle-off'"></div>
                  </label>
                </div>
              </div>

              <!-- Dark Mode Setting -->
              <div class="setting-card">
                <div class="setting-content">
                  <div class="setting-info">
                    <span class="setting-icon">🌙</span>
                    <div>
                      <div class="setting-name">Dark Mode</div>
                      <div class="setting-desc">Switch to dark theme</div>
                    </div>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="settings.darkMode" class="toggle-input">
                    <div class="toggle-slider" :class="settings.darkMode ? 'toggle-on' : 'toggle-off'"></div>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Difficulty Preference -->
          <div class="difficulty-section">
            <div class="section-header">
              <h3 class="section-title">
                <span>🎯</span>
                Default Difficulty
              </h3>
              <p class="section-description">Choose your preferred game difficulty</p>
            </div>

            <div class="difficulty-grid">
              <button
                v-for="diff in difficulties"
                :key="diff.value"
                @click="settings.difficulty = diff.value"
                :class="[
                  'difficulty-btn',
                  getDifficultyClass(diff.value)
                ]"
              >
                <div class="difficulty-icon">{{ diff.icon }}</div>
                <div class="difficulty-name">{{ diff.label.split(' ')[0] }}</div>
                <div class="difficulty-time">{{ diff.label.split(' ')[1] }}</div>
              </button>
            </div>
          </div>

          <!-- Theme Selection -->
          <div class="theme-section">
            <div class="section-header">
              <h3 class="section-title">
                <span>🎨</span>
                Theme & Appearance
              </h3>
              <p class="section-description">Customize your visual experience</p>
            </div>

            <div class="theme-grid">
              <button
                v-for="theme in themes"
                :key="theme.value"
                @click="settings.theme = theme.value"
                :class="[
                  'theme-btn',
                  settings.theme === theme.value ? 'theme-selected' : 'theme-unselected'
                ]"
              >
                <div class="theme-preview">{{ theme.preview }}</div>
                <div class="theme-name">{{ theme.label }}</div>
                <div class="theme-colors">
                  <div
                    v-for="color in theme.colors"
                    :key="color"
                    class="color-dot"
                    :style="{ backgroundColor: color }"
                  ></div>
                </div>
              </button>
            </div>
          </div>

          <!-- Language Selection -->
          <div class="language-section">
            <div class="section-header">
              <h3 class="section-title">
                <span>🌍</span>
                Language
              </h3>
              <p class="section-description">Choose your preferred language</p>
            </div>

            <div class="language-select-wrapper">
              <select
                v-model="settings.language"
                class="language-select"
              >
                <option v-for="lang in languages" :key="lang.value" :value="lang.value">
                  {{ lang.flag }} {{ lang.label }}
                </option>
              </select>
              <div class="select-arrow">▼</div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="action-buttons">
            <button
              @click="saveSettings"
              :disabled="saveStatus === 'saving'"
              :class="[
                'save-btn',
                saveStatus === 'saving' ? 'saving' : ''
              ]"
            >
              {{ getSaveButtonText }}
            </button>
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
import { ref, computed, onMounted, watch } from 'vue';
import { useBackgroundMusic } from '@/composables/useBackgroundMusic';

const { isMusicEnabled, volume, setMusicEnabled, setVolume, initAudio } = useBackgroundMusic();

const settings = ref({
  sound: true,
  darkMode: false,
  notifications: true,
  difficulty: 'medium',
  autoSubmit: false,
  language: 'en',
  theme: 'banana',
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

const difficulties = [
  { value: 'easy', label: 'Easy (12s)', icon: '🥥', color: 'diff-easy' },
  { value: 'medium', label: 'Medium (8s)', icon: '🍍', color: 'diff-medium' },
  { value: 'hard', label: 'Hard (5s)', icon: '🌶️', color: 'diff-hard' }
];

function getDifficultyClass(value) {
  let classes = 'difficulty-btn-base';
  if (settings.value.difficulty === value) {
    classes += ' difficulty-selected';
  } else {
    classes += ' difficulty-unselected';
  }
  return classes;
}

const languages = [
  { value: 'en', label: 'English', flag: '🇺🇸' },
  { value: 'es', label: 'Español', flag: '🇪🇸' },
  { value: 'fr', label: 'Français', flag: '🇫🇷' },
  { value: 'de', label: 'Deutsch', flag: '🇩🇪' }
];

const themes = [
  { value: 'banana', label: 'Banana Classic', preview: '🍌', colors: ['#fbbf24', '#f59e0b'] },
  { value: 'ocean', label: 'Ocean Blue', preview: '🌊', colors: ['#3b82f6', '#1d4ed8'] },
  { value: 'forest', label: 'Forest Green', preview: '🌲', colors: ['#10b981', '#059669'] },
  { value: 'sunset', label: 'Sunset Orange', preview: '🌅', colors: ['#f97316', '#ea580c'] }
];

const saveStatus = ref('');

function saveSettings() {
  saveStatus.value = 'saving';
  // Simulate API call
  setTimeout(() => {
    console.log('Settings saved:', settings.value);
    saveStatus.value = 'saved';
    setTimeout(() => {
      saveStatus.value = '';
    }, 2000);
  }, 1000);
}

const getSaveButtonText = computed(() => {
  switch (saveStatus.value) {
    case 'saving': return '💾 Saving...';
    case 'saved': return '✅ Saved!';
    default: return '💾 Save Settings';
  }
});
</script>

<style scoped>
/* Keyframes */
@keyframes bounce {
  0%, 20%, 53%, 80%, 100% { transform: translate3d(0, 0, 0); }
  40%, 43% { transform: translate3d(0, -30px, 0); }
  70% { transform: translate3d(0, -15px, 0); }
  90% { transform: translate3d(0, -4px, 0); }
}

/* Main container */
.settings-container {
  min-height: 100vh;
  background: linear-gradient(to bottom right, #fde047, #fbbf24, #fde047);
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

/* Floating decorations */
.decoration-left {
  position: absolute;
  left: 1.5rem;
  top: 1.5rem;
  font-size: 4rem;
  animation: bounce 3s infinite;
}

.decoration-right {
  position: absolute;
  right: 1.5rem;
  bottom: 1.5rem;
  font-size: 4rem;
  animation: bounce 3s infinite;
  animation-delay: 1s;
}

.decoration-top {
  position: absolute;
  top: 25%;
  right: 3rem;
  font-size: 4rem;
  animation: bounce 3s infinite;
  animation-delay: 2s;
}

.decoration-bottom {
  position: absolute;
  bottom: 25%;
  left: 3rem;
  font-size: 4rem;
  animation: bounce 3s infinite;
  animation-delay: 0.5s;
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
  animation: bounce 2s infinite;
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
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
  background: linear-gradient(to bottom right, #fefce8, white);
  border-radius: 0.75rem;
  padding: 1rem;
  border: 2px solid #fed7aa;
  transition: all 0.3s;
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
  background: linear-gradient(135deg, #eab308 0%, #f59e0b 100%);
  box-shadow: 0 0 12px rgba(234, 179, 8, 0.5), inset 0 1px 2px rgba(255, 255, 255, 0.3);
}

.toggle-on:before {
  transform: translateX(1.5rem);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 0 8px rgba(234, 179, 8, 0.4);
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
  background: linear-gradient(to right, #fed7aa 0%, #fbbf24 100%);
  outline: none;
  appearance: none;
  cursor: pointer;
  transition: all 0.3s;
}

.volume-slider::-webkit-slider-thumb {
  appearance: none;
  width: 1.25rem;
  height: 1.25rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(251, 191, 36, 0.6);
  transition: all 0.3s;
}

.volume-slider::-webkit-slider-thumb:hover {
  transform: scale(1.2);
  box-shadow: 0 4px 12px rgba(251, 191, 36, 0.8);
}

.volume-slider::-moz-range-thumb {
  width: 1.25rem;
  height: 1.25rem;
  border-radius: 50%;
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
  cursor: pointer;
  border: none;
  box-shadow: 0 2px 8px rgba(251, 191, 36, 0.6);
  transition: all 0.3s;
}

.volume-slider::-moz-range-thumb:hover {
  transform: scale(1.2);
  box-shadow: 0 4px 12px rgba(251, 191, 36, 0.8);
}

/* Difficulty section */
.difficulty-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.difficulty-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}

.difficulty-btn {
  border-radius: 0.75rem;
  padding: 1.5rem;
  text-align: center;
  transition: all 0.3s;
  transform: scale(1);
}

.difficulty-btn:hover {
  transform: scale(1.05);
}

.difficulty-btn-base {
  border-radius: 0.75rem;
  padding: 1.5rem;
  text-align: center;
  transition: all 0.3s;
  transform: scale(1);
  opacity: 0.7;
}

.difficulty-btn-base:hover {
  opacity: 1;
  transform: scale(1.05);
}

.difficulty-selected {
  box-shadow: 0 0 0 4px #fbbf24, 0 0 20px rgba(251, 191, 36, 0.6), 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transform: scale(1.08);
  filter: brightness(1.1);
}

.difficulty-unselected {
  opacity: 0.7;
}

.difficulty-unselected:hover {
  opacity: 1;
}

.diff-easy {
  background-color: #22c55e;
  color: white;
}

.diff-medium {
  background-color: #eab308;
  color: white;
}

.diff-hard {
  background-color: #ef4444;
  color: white;
}

.difficulty-icon {
  font-size: 1.875rem;
  margin-bottom: 0.5rem;
}

.difficulty-name {
  font-weight: 600;
  color: white;
}

.difficulty-time {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.8);
}

/* Theme section */
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
  background: linear-gradient(to bottom right, #f9fafb, white);
  border-radius: 0.75rem;
  padding: 1rem;
  border: 2px solid;
  transition: all 0.3s;
  text-align: center;
  transform: scale(1);
}

.theme-btn:hover {
  transform: scale(1.05);
}

.theme-selected {
  border-color: #eab308;
  box-shadow: 0 0 0 4px #fef3c7, 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
  background: linear-gradient(to bottom right, #fefce8, white);
  border: 2px solid #fed7aa;
  border-radius: 0.75rem;
  color: #1f2937;
  font-weight: 500;
  outline: none;
  cursor: pointer;
  appearance: none;
  transition: all 0.3s;
}

.language-select:focus {
  box-shadow: 0 0 0 4px #fef3c7;
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

.save-btn {
  flex: 1;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: bold;
  font-size: 1.125rem;
  transition: all 0.3s;
  transform: scale(1);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background-color: #eab308;
  color: white;
}

.save-btn:hover {
  background-color: #ca8a04;
  transform: scale(1.05);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.save-btn.saving {
  opacity: 0.75;
  cursor: not-allowed;
}

.home-btn {
  flex: 1;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: bold;
  font-size: 1.125rem;
  transition: all 0.3s;
  transform: scale(1);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  background-color: white;
  color: #a16207;
  border: 2px solid #fbbf24;
  text-align: center;
}

.home-btn:hover {
  background-color: #fefce8;
  transform: scale(1.05);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>
