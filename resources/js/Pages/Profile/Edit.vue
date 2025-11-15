<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useBackgroundMusic } from '@/composables/useBackgroundMusic';

const { initAudio } = useBackgroundMusic();

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

onMounted(() => {
  initAudio();
});
</script>

<template>
    <Head title="Profile" />

    <div class="profile-container">
        <!-- User menu -->
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
        </div>

        <!-- Banana decorations -->
        <div class="banana-left">🍌</div>
        <div class="banana-right">🍌</div>
        <div class="banana-top">🍌</div>

        <!-- Main Content -->
        <div class="profile-card-wrapper">
            <div class="text-center mb-6">
                <div class="hero-icon">👤</div>
                <h1 class="hero-title">Profile Settings</h1>
                <p class="hero-subtitle">Manage your account information and preferences</p>
            </div>

            <div class="cards-container">
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="header-content">
                            <span class="header-icon">📝</span>
                            <h3 class="header-title">Account Information</h3>
                        </div>
                    </div>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </div>

                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="header-content">
                            <span class="header-icon">🔒</span>
                            <h3 class="header-title">Security Settings</h3>
                        </div>
                    </div>
                    <UpdatePasswordForm />
                </div>

                <div class="profile-card danger-card">
                    <div class="profile-card-header danger-header">
                        <div class="header-content">
                            <span class="header-icon">⚠️</span>
                            <h3 class="header-title danger-title">Danger Zone</h3>
                        </div>
                    </div>
                    <DeleteUserForm />
                </div>
            </div>

            <!-- Navigation Footer -->
            <div class="nav-footer">
                <Link href="/home" class="home-btn">
                    <span>🏠</span>
                    <span>Back to Home</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes gradient-shift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes float-y {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-10px); }
}

@keyframes pulse-subtle {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.9; transform: scale(1.02); }
}

.profile-container {
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

.banana-top {
  position: absolute;
  top: 33.333333%;
  right: 4rem;
  font-size: 3rem;
  animation: float-y 3s ease-in-out infinite;
  animation-delay: 2s;
  user-select: none;
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
  opacity: 0.6;
}

.profile-card-wrapper {
  background-color: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  border: 1px solid #fed7aa;
  border-radius: 1rem;
  padding: 1.25rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  width: 100%;
  max-width: 56rem;
  z-index: 10;
}

.profile-card-wrapper:hover {
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  border-color: #fdba74;
}

.hero-icon {
  font-size: 3rem;
  margin-bottom: 0.75rem;
  animation: pulse-subtle 3s ease-in-out infinite;
}

.hero-title {
  font-size: 2rem;
  font-weight: 800;
  color: #92400e;
  margin-bottom: 0.5rem;
}

.hero-subtitle {
  color: #d97706;
  font-size: 1rem;
}

.cards-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.profile-card {
  background: linear-gradient(135deg, #FFFFFF 0%, #FFFBEB 100%);
  border-radius: 0.75rem;
  border: 2px solid #fed7aa;
  overflow: hidden;
  transition: all 0.3s;
}

.profile-card:hover {
  box-shadow: 0 8px 16px -4px rgba(251, 191, 36, 0.3);
  border-color: #fbbf24;
}

.danger-card {
  border-color: #fecaca;
}

.danger-card:hover {
  border-color: #ef4444;
  box-shadow: 0 8px 16px -4px rgba(239, 68, 68, 0.3);
}

.profile-card-header {
  padding: 1rem;
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  border-bottom: 2px solid #fed7aa;
}

.danger-header {
  background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
  border-bottom: 2px solid #fecaca;
}

.header-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.header-icon {
  font-size: 1.5rem;
}

.header-title {
  font-size: 1.125rem;
  font-weight: 700;
  color: #92400e;
}

.danger-title {
  color: #dc2626;
}

.nav-footer {
  text-align: center;
  margin-top: 1.5rem;
}

.home-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
  color: #FFFFFF;
  border-radius: 0.75rem;
  box-shadow: 0 8px 16px -4px rgba(251, 191, 36, 0.4), 0 4px 8px -2px rgba(245, 158, 11, 0.3);
  transition: all 0.3s;
  font-weight: 600;
}

.home-btn:hover {
  box-shadow: 0 20px 30px -8px rgba(251, 191, 36, 0.6), 0 8px 16px -4px rgba(245, 158, 11, 0.4);
  background: linear-gradient(135deg, #F59E0B 0%, #EA580C 100%);
  transform: scale(1.05) translateY(-2px);
}
</style>
