<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const settings = ref({
  sound: true,
  darkMode: false,
  notifications: true,
  difficulty: 'medium',
  autoSubmit: false,
  language: 'en',
  theme: 'banana'
});

const difficulties = [
  { value: 'easy', label: 'Easy (12s)', icon: '🥥', color: 'bg-green-500' },
  { value: 'medium', label: 'Medium (8s)', icon: '🍍', color: 'bg-yellow-500' },
  { value: 'hard', label: 'Hard (5s)', icon: '🌶️', color: 'bg-red-500' }
];

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

<template>
  <div class="min-h-screen bg-animated-yellow relative overflow-hidden">
    <!-- Enhanced floating decorations -->
    <div class="absolute left-6 top-6 banana-header-icon animate-float-y">🍌</div>
    <div class="absolute right-6 bottom-6 banana-header-icon animate-float-y" style="animation-delay: 1s;">🍌</div>
    <div class="absolute top-1/4 right-12 banana-header-icon animate-float-y" style="animation-delay: 2s;">⚙️</div>
    <div class="absolute bottom-1/4 left-12 banana-header-icon animate-float-y" style="animation-delay: 0.5s;">🎮</div>

    <div class="flex flex-col items-center justify-center min-h-screen py-12">
      <!-- Header Section -->
      <div class="text-center mb-8">
        <div class="text-8xl mb-6 animate-float-y">⚙️</div>
        <h1 class="text-4xl font-bold text-yellow-800 mb-4">Game Settings</h1>
        <p class="text-xl text-yellow-700 max-w-md mx-auto">
          Customize your banana catching experience to perfection
        </p>
      </div>

      <!-- Settings Container -->
      <div class="w-full max-w-4xl mx-4">
        <div class="settings-container">
          
          <!-- Game Preferences Section -->
          <div class="settings-section">
            <div class="settings-section-header">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🎮</span>
                Game Preferences
              </h3>
              <p class="text-yellow-600 text-sm">Configure your gameplay experience</p>
            </div>

            <div class="settings-grid">
              <!-- Sound Setting -->
              <div class="setting-card">
                <div class="setting-header">
                  <span class="setting-icon">🎵</span>
                  <div>
                    <div class="setting-title">Sound Effects</div>
                    <div class="setting-description">Enable audio feedback and music</div>
                  </div>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" v-model="settings.sound" class="sr-only">
                  <div class="toggle-slider" :class="settings.sound ? 'bg-yellow-500' : 'bg-gray-300'">
                    <div class="toggle-knob" :class="settings.sound ? 'translate-x-6' : 'translate-x-1'"></div>
                  </div>
                </label>
              </div>

              <!-- Auto Submit Setting -->
              <div class="setting-card">
                <div class="setting-header">
                  <span class="setting-icon">⚡</span>
                  <div>
                    <div class="setting-title">Auto Submit</div>
                    <div class="setting-description">Submit answers automatically when entered</div>
                  </div>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" v-model="settings.autoSubmit" class="sr-only">
                  <div class="toggle-slider" :class="settings.autoSubmit ? 'bg-yellow-500' : 'bg-gray-300'">
                    <div class="toggle-knob" :class="settings.autoSubmit ? 'translate-x-6' : 'translate-x-1'"></div>
                  </div>
                </label>
              </div>

              <!-- Notifications Setting -->
              <div class="setting-card">
                <div class="setting-header">
                  <span class="setting-icon">🔔</span>
                  <div>
                    <div class="setting-title">Notifications</div>
                    <div class="setting-description">Get achievement and progress alerts</div>
                  </div>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" v-model="settings.notifications" class="sr-only">
                  <div class="toggle-slider" :class="settings.notifications ? 'bg-yellow-500' : 'bg-gray-300'">
                    <div class="toggle-knob" :class="settings.notifications ? 'translate-x-6' : 'translate-x-1'"></div>
                  </div>
                </label>
              </div>

              <!-- Dark Mode Setting -->
              <div class="setting-card">
                <div class="setting-header">
                  <span class="setting-icon">🌙</span>
                  <div>
                    <div class="setting-title">Dark Mode</div>
                    <div class="setting-description">Switch to dark theme interface</div>
                  </div>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" v-model="settings.darkMode" class="sr-only">
                  <div class="toggle-slider" :class="settings.darkMode ? 'bg-yellow-500' : 'bg-gray-300'">
                    <div class="toggle-knob" :class="settings.darkMode ? 'translate-x-6' : 'translate-x-1'"></div>
                  </div>
                </label>
              </div>
            </div>
          </div>

          <!-- Difficulty Preference -->
          <div class="settings-section">
            <div class="settings-section-header">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🎯</span>
                Default Difficulty
              </h3>
              <p class="text-yellow-600 text-sm">Choose your preferred game difficulty</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
              <button
                v-for="diff in difficulties"
                :key="diff.value"
                @click="settings.difficulty = diff.value"
                :class="[
                  'difficulty-option',
                  settings.difficulty === diff.value ? 'selected' : '',
                  diff.color
                ]"
              >
                <div class="text-3xl mb-2">{{ diff.icon }}</div>
                <div class="font-semibold text-white">{{ diff.label.split(' ')[0] }}</div>
                <div class="text-white/80 text-xs">{{ diff.label.split(' ')[1] }}</div>
              </button>
            </div>
          </div>

          <!-- Theme Selection -->
          <div class="settings-section">
            <div class="settings-section-header">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🎨</span>
                Theme & Appearance
              </h3>
              <p class="text-yellow-600 text-sm">Customize your visual experience</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <button
                v-for="theme in themes"
                :key="theme.value"
                @click="settings.theme = theme.value"
                :class="[
                  'theme-option',
                  settings.theme === theme.value ? 'selected-theme' : ''
                ]"
              >
                <div class="text-3xl mb-2">{{ theme.preview }}</div>
                <div class="font-medium text-gray-800">{{ theme.label }}</div>
                <div class="flex gap-1 mt-2 justify-center">
                  <div 
                    v-for="color in theme.colors" 
                    :key="color"
                    class="w-3 h-3 rounded-full"
                    :style="{ backgroundColor: color }"
                  ></div>
                </div>
              </button>
            </div>
          </div>

          <!-- Language Selection -->
          <div class="settings-section">
            <div class="settings-section-header">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🌍</span>
                Language
              </h3>
              <p class="text-yellow-600 text-sm">Choose your preferred language</p>
            </div>

            <div class="relative">
              <select 
                v-model="settings.language" 
                class="language-select"
              >
                <option v-for="lang in languages" :key="lang.value" :value="lang.value">
                  {{ lang.flag }} {{ lang.label }}
                </option>
              </select>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 pt-6">
            <button
              @click="saveSettings"
              :disabled="saveStatus === 'saving'"
              :class="[
                'action-btn',
                saveStatus === 'saving' ? 'opacity-75 cursor-not-allowed' : ''
              ]"
              class="bg-yellow-500 hover:bg-yellow-600 text-white flex-1"
            >
              {{ getSaveButtonText }}
            </button>
            <Link href="/home" class="action-btn bg-white text-yellow-700 border-2 border-yellow-400 hover:bg-yellow-50">
              🏠 Back to Home
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
          </div>
          <div class="grid grid-cols-3 gap-2">
            <button
              v-for="diff in difficulties"
              :key="diff.value"
              @click="settings.difficulty = diff.value"
              :class="settings.difficulty === diff.value ? 'bg-yellow-500 text-white' : 'bg-white text-gray-700'"
              class="p-3 rounded-lg text-center transition-all duration-200 hover:scale-105"
            >
              <div class="text-lg">{{ diff.icon }}</div>
              <div class="text-xs font-medium">{{ diff.label }}</div>
            </button>
          </div>
        </div>

        <!-- Auto Submit -->
        <div class="bg-white/50 rounded-xl p-4">
          <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
              <span class="text-2xl">⚡</span>
              <div>
                <div class="font-semibold text-gray-800">Auto Submit</div>
                <div class="text-sm text-gray-600">Submit answers automatically</div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" v-model="settings.autoSubmit" class="sr-only peer">
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500"></div>
            </label>
          </div>
        </div>
      </div>

      <div class="mt-8 flex flex-col sm:flex-row gap-4">
        <button
          @click="saveSettings"
          class="flex-1 px-6 py-3 bg-yellow-500 text-white rounded-xl shadow-lg hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 font-semibold"
        >
          {{ getSaveButtonText }}
        </button>
        <Link href="/home" class="px-6 py-3 bg-white text-yellow-700 border-2 border-yellow-400 rounded-xl shadow-lg hover:bg-yellow-50 transition-all duration-300 transform hover:scale-105 font-semibold text-center">
          🏠 Back to Home
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.settings-container {
  @apply bg-white/95 backdrop-blur-sm border border-yellow-200 rounded-3xl shadow-2xl p-8 space-y-8;
}

.settings-section {
  @apply space-y-6;
}

.settings-section-header {
  @apply border-b border-yellow-100 pb-4;
}

.settings-grid {
  @apply grid grid-cols-1 md:grid-cols-2 gap-4;
}

.setting-card {
  @apply bg-white/70 rounded-xl p-4 border border-yellow-100 hover:shadow-md transition-all duration-300;
}

.setting-header {
  @apply flex items-center justify-between;
}

.setting-icon {
  @apply text-2xl mr-3;
}

.setting-title {
  @apply font-semibold text-gray-800;
}

.setting-description {
  @apply text-sm text-gray-600;
}

.toggle-switch {
  @apply relative inline-flex items-center cursor-pointer;
}

.toggle-slider {
  @apply w-12 h-6 rounded-full transition-colors duration-300 relative;
}

.toggle-knob {
  @apply absolute top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300;
}

.difficulty-option {
  @apply p-4 rounded-xl text-center transition-all duration-300 transform hover:scale-105 relative;
}

.difficulty-option.selected {
  @apply ring-4 ring-white ring-opacity-50 scale-105;
}

.theme-option {
  @apply p-4 bg-white rounded-xl border-2 border-gray-200 text-center transition-all duration-300 hover:border-yellow-300 hover:shadow-md;
}

.theme-option.selected-theme {
  @apply border-yellow-500 bg-yellow-50 shadow-lg;
}

.language-select {
  @apply w-full p-4 bg-white border-2 border-yellow-200 rounded-xl focus:border-yellow-500 focus:outline-none text-gray-800 font-medium;
}

.action-btn {
  @apply px-6 py-4 rounded-xl font-semibold text-center transition-all duration-300 transform hover:scale-105 hover:shadow-lg;
}
</style>
