
<template>
  <div class="min-h-screen bg-gradient-to-br from-yellow-300 via-yellow-200 to-yellow-300 relative overflow-hidden">
    <!-- Enhanced floating decorations -->
    <div class="absolute left-6 top-6 text-6xl animate-bounce" style="animation-duration: 3s;">🍌</div>
    <div class="absolute right-6 bottom-6 text-6xl animate-bounce" style="animation-duration: 3s; animation-delay: 1s;">🍌</div>
    <div class="absolute top-1/4 right-12 text-6xl animate-bounce" style="animation-duration: 3s; animation-delay: 2s;">⚙️</div>
    <div class="absolute bottom-1/4 left-12 text-6xl animate-bounce" style="animation-duration: 3s; animation-delay: 0.5s;">🎮</div>

    <div class="flex flex-col items-center justify-center min-h-screen py-12">
      <!-- Header Section -->
      <div class="text-center mb-8">
        <div class="text-8xl mb-6 animate-bounce" style="animation-duration: 2s;">⚙️</div>
        <h1 class="text-4xl font-bold text-yellow-800 mb-4">Game Settings</h1>
        <p class="text-xl text-yellow-700 max-w-md mx-auto">
          Customize your banana catching experience to perfection
        </p>
      </div>

      <!-- Settings Container -->
      <div class="w-full max-w-4xl mx-4">
        <div class="bg-white rounded-3xl shadow-2xl p-8 space-y-8">
          
          <!-- Game Preferences Section -->
          <div class="space-y-4">
            <div class="border-b-2 border-yellow-200 pb-3">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🎮</span>
                Game Preferences
              </h3>
              <p class="text-yellow-600 text-sm">Configure your gameplay experience</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- Sound Setting -->
              <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border-2 border-yellow-200 hover:border-yellow-400 transition-all">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <span class="text-3xl">🎵</span>
                    <div>
                      <div class="font-semibold text-gray-800">Sound Effects</div>
                      <div class="text-sm text-gray-600">Enable audio feedback and music</div>
                    </div>
                  </div>
                  <label class="relative inline-block w-14 h-8 cursor-pointer">
                    <input type="checkbox" v-model="settings.sound" class="sr-only peer">
                    <div class="w-14 h-8 bg-gray-300 peer-checked:bg-yellow-500 rounded-full transition-all duration-300 relative">
                      <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300" 
                           :class="settings.sound ? 'translate-x-6' : 'translate-x-0'"></div>
                    </div>
                  </label>
                </div>
              </div>

              <!-- Auto Submit Setting -->
              <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border-2 border-yellow-200 hover:border-yellow-400 transition-all">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <span class="text-3xl">⚡</span>
                    <div>
                      <div class="font-semibold text-gray-800">Auto Submit</div>
                      <div class="text-sm text-gray-600">Submit answers automatically</div>
                    </div>
                  </div>
                  <label class="relative inline-block w-14 h-8 cursor-pointer">
                    <input type="checkbox" v-model="settings.autoSubmit" class="sr-only peer">
                    <div class="w-14 h-8 bg-gray-300 peer-checked:bg-yellow-500 rounded-full transition-all duration-300 relative">
                      <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300" 
                           :class="settings.autoSubmit ? 'translate-x-6' : 'translate-x-0'"></div>
                    </div>
                  </label>
                </div>
              </div>

              <!-- Notifications Setting -->
              <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border-2 border-yellow-200 hover:border-yellow-400 transition-all">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <span class="text-3xl">🔔</span>
                    <div>
                      <div class="font-semibold text-gray-800">Notifications</div>
                      <div class="text-sm text-gray-600">Get achievement alerts</div>
                    </div>
                  </div>
                  <label class="relative inline-block w-14 h-8 cursor-pointer">
                    <input type="checkbox" v-model="settings.notifications" class="sr-only peer">
                    <div class="w-14 h-8 bg-gray-300 peer-checked:bg-yellow-500 rounded-full transition-all duration-300 relative">
                      <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300" 
                           :class="settings.notifications ? 'translate-x-6' : 'translate-x-0'"></div>
                    </div>
                  </label>
                </div>
              </div>

              <!-- Dark Mode Setting -->
              <div class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border-2 border-yellow-200 hover:border-yellow-400 transition-all">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <span class="text-3xl">🌙</span>
                    <div>
                      <div class="font-semibold text-gray-800">Dark Mode</div>
                      <div class="text-sm text-gray-600">Switch to dark theme</div>
                    </div>
                  </div>
                  <label class="relative inline-block w-14 h-8 cursor-pointer">
                    <input type="checkbox" v-model="settings.darkMode" class="sr-only peer">
                    <div class="w-14 h-8 bg-gray-300 peer-checked:bg-yellow-500 rounded-full transition-all duration-300 relative">
                      <div class="absolute top-1 left-1 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300" 
                           :class="settings.darkMode ? 'translate-x-6' : 'translate-x-0'"></div>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Difficulty Preference -->
          <div class="space-y-4">
            <div class="border-b-2 border-yellow-200 pb-3">
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
                  'rounded-xl p-6 text-center transition-all duration-300 transform hover:scale-105',
                  diff.color,
                  settings.difficulty === diff.value ? 'ring-4 ring-yellow-400 shadow-xl scale-105' : 'opacity-70 hover:opacity-100'
                ]"
              >
                <div class="text-3xl mb-2">{{ diff.icon }}</div>
                <div class="font-semibold text-white">{{ diff.label.split(' ')[0] }}</div>
                <div class="text-white/80 text-xs">{{ diff.label.split(' ')[1] }}</div>
              </button>
            </div>
          </div>

          <!-- Theme Selection -->
          <div class="space-y-4">
            <div class="border-b-2 border-yellow-200 pb-3">
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
                  'bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 transition-all duration-300 hover:scale-105 text-center',
                  settings.theme === theme.value ? 'border-yellow-500 ring-4 ring-yellow-300 shadow-xl' : 'border-gray-200 hover:border-yellow-300'
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
          <div class="space-y-4">
            <div class="border-b-2 border-yellow-200 pb-3">
              <h3 class="text-xl font-bold text-yellow-700 flex items-center gap-2">
                <span>🌍</span>
                Language
              </h3>
              <p class="text-yellow-600 text-sm">Choose your preferred language</p>
            </div>

            <div class="relative">
              <select 
                v-model="settings.language" 
                class="w-full px-4 py-3 bg-gradient-to-br from-yellow-50 to-white border-2 border-yellow-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-4 focus:ring-yellow-300 focus:border-yellow-400 appearance-none cursor-pointer"
              >
                <option v-for="lang in languages" :key="lang.value" :value="lang.value">
                  {{ lang.flag }} {{ lang.label }}
                </option>
              </select>
              <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none text-yellow-600">
                ▼
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 pt-6">
            <button
              @click="saveSettings"
              :disabled="saveStatus === 'saving'"
              :class="[
                'flex-1 px-6 py-3 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg',
                'bg-yellow-500 hover:bg-yellow-600 text-white',
                saveStatus === 'saving' ? 'opacity-75 cursor-not-allowed' : ''
              ]"
            >
              {{ getSaveButtonText }}
            </button>
            <Link href="/home" class="flex-1 px-6 py-3 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg bg-white text-yellow-700 border-2 border-yellow-400 hover:bg-yellow-50 text-center">
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
