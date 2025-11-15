import { ref, watch } from 'vue';

// Global state for background music
const audio = ref(null);
const isPlaying = ref(false);
const isMusicEnabled = ref(true);
const volume = ref(0.3); // 30% volume by default

// Initialize audio
const initAudio = () => {
  if (!audio.value) {
    audio.value = new Audio('/audio/background-music.mp3');
    audio.value.loop = true;
    audio.value.volume = volume.value;
    
    // Load settings from localStorage
    const savedSettings = localStorage.getItem('musicSettings');
    if (savedSettings) {
      const settings = JSON.parse(savedSettings);
      isMusicEnabled.value = settings.enabled !== false; // Default to true
      volume.value = settings.volume || 0.3;
      audio.value.volume = volume.value;
    }
    
    // Auto-play if enabled
    if (isMusicEnabled.value) {
      playMusic();
    }
  }
};

const playMusic = () => {
  if (audio.value && isMusicEnabled.value) {
    audio.value.play().catch(err => {
      console.log('Music autoplay prevented:', err);
    });
    isPlaying.value = true;
  }
};

const pauseMusic = () => {
  if (audio.value) {
    audio.value.pause();
    isPlaying.value = false;
  }
};

const toggleMusic = () => {
  if (isPlaying.value) {
    pauseMusic();
  } else {
    playMusic();
  }
};

const setMusicEnabled = (enabled) => {
  isMusicEnabled.value = enabled;
  
  if (enabled) {
    playMusic();
  } else {
    pauseMusic();
  }
  
  // Save to localStorage
  saveSettings();
};

const setVolume = (newVolume) => {
  volume.value = newVolume;
  if (audio.value) {
    audio.value.volume = newVolume;
  }
  saveSettings();
};

const saveSettings = () => {
  localStorage.setItem('musicSettings', JSON.stringify({
    enabled: isMusicEnabled.value,
    volume: volume.value
  }));
};

// Watch for changes and save
watch([isMusicEnabled, volume], () => {
  saveSettings();
});

export const useBackgroundMusic = () => {
  return {
    audio,
    isPlaying,
    isMusicEnabled,
    volume,
    initAudio,
    playMusic,
    pauseMusic,
    toggleMusic,
    setMusicEnabled,
    setVolume
  };
};
