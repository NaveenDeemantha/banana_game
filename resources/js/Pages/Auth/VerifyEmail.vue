<script setup>
import { ref } from 'vue';
import { useForm, Link, router, usePage, Head } from '@inertiajs/vue3';

const page = usePage();
const resendProcessing = ref(false);

const form = useForm({
  otp: '',
});

const status = ref(page.props.status || '');

function formatOTP(event) {
  // Only allow numbers
  form.otp = event.target.value.replace(/\D/g, '');
}

function submit() {
  form.post(route('verification.verify'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
}

function resendOTP() {
  resendProcessing.value = true;
  router.post(route('verification.resend'), {}, {
    preserveScroll: true,
    onFinish: () => {
      resendProcessing.value = false;
    },
    onSuccess: () => {
      status.value = 'A new OTP has been sent to your email address.';
    },
  });
}
</script>

<template>
  <Head title="Verify Email" />

  <div class="verify-container">
    <div class="verify-card">
      <div class="header">
        <div class="icon">📧</div>
        <h1>Verify Your Email</h1>
        <p class="subtitle">
          We've sent a 6-digit code to <strong>{{ $page.props.auth.user.email }}</strong>
        </p>
      </div>

      <form @submit.prevent="submit" class="form">
        <div v-if="form.errors.otp" class="error-message">
          {{ form.errors.otp }}
        </div>

        <div v-if="status" class="success-message">
          {{ status }}
        </div>

        <div class="otp-section">
          <label for="otp">Enter OTP Code</label>
          <input
            id="otp"
            v-model="form.otp"
            type="text"
            maxlength="6"
            placeholder="000000"
            class="otp-input"
            :disabled="form.processing"
            @input="formatOTP"
            autofocus
          />
          <p class="hint">Enter the 6-digit code from your email</p>
        </div>

        <button
          type="submit"
          class="verify-btn"
          :disabled="form.processing || form.otp.length !== 6"
        >
          <span v-if="form.processing">Verifying...</span>
          <span v-else>Verify Email</span>
        </button>

        <div class="resend-section">
          <p>Didn't receive the code?</p>
          <button
            type="button"
            @click="resendOTP"
            class="resend-btn"
            :disabled="resendProcessing"
          >
            <span v-if="resendProcessing">Sending...</span>
            <span v-else>Resend OTP</span>
          </button>
        </div>
      </form>

      <div class="footer-links">
        <Link :href="route('logout')" method="post" as="button" class="logout-link">
          Logout
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.verify-container {
  min-height: 100vh;
  background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 25%, #FCD34D 50%, #FBBF24 75%, #F59E0B 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.verify-card {
  background: white;
  border-radius: 1rem;
  padding: 3rem;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.header {
  text-align: center;
  margin-bottom: 2rem;
}

.icon {
  font-size: 4rem;
  margin-bottom: 1rem;
}

h1 {
  font-size: 2rem;
  font-weight: 700;
  color: #CA8A04;
  margin-bottom: 0.5rem;
}

.subtitle {
  color: #6B7280;
  font-size: 0.95rem;
}

.subtitle strong {
  color: #374151;
}

.form {
  margin-top: 2rem;
}

.error-message {
  background: #FEE2E2;
  color: #991B1B;
  padding: 0.75rem;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.success-message {
  background: #DCFCE7;
  color: #166534;
  padding: 0.75rem;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.otp-section {
  margin-bottom: 1.5rem;
}

.otp-section label {
  display: block;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.otp-input {
  width: 100%;
  padding: 1rem;
  font-size: 2rem;
  text-align: center;
  letter-spacing: 0.5rem;
  border: 2px solid #FDE047;
  border-radius: 0.5rem;
  outline: none;
  font-weight: 700;
  color: #CA8A04;
  transition: all 0.3s;
}

.otp-input:focus {
  border-color: #F59E0B;
  box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
}

.otp-input:disabled {
  background: #F3F4F6;
  cursor: not-allowed;
}

.hint {
  margin-top: 0.5rem;
  font-size: 0.875rem;
  color: #6B7280;
}

.verify-btn {
  width: 100%;
  padding: 1rem;
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
  color: white;
  border: none;
  border-radius: 0.5rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.verify-btn:hover:not(:disabled) {
  background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
  transform: translateY(-1px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.verify-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.resend-section {
  margin-top: 2rem;
  text-align: center;
  padding-top: 1.5rem;
  border-top: 1px solid #E5E7EB;
}

.resend-section p {
  color: #6B7280;
  font-size: 0.875rem;
  margin-bottom: 0.5rem;
}

.resend-btn {
  background: none;
  border: none;
  color: #F59E0B;
  font-weight: 600;
  cursor: pointer;
  font-size: 0.875rem;
  transition: color 0.3s;
}

.resend-btn:hover:not(:disabled) {
  color: #D97706;
  text-decoration: underline;
}

.resend-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.footer-links {
  margin-top: 2rem;
  text-align: center;
  padding-top: 1.5rem;
  border-top: 1px solid #E5E7EB;
}

.logout-link {
  background: none;
  border: none;
  color: #DC2626;
  font-weight: 500;
  cursor: pointer;
  font-size: 0.875rem;
  transition: color 0.3s;
}

.logout-link:hover {
  color: #B91C1C;
  text-decoration: underline;
}

@media (max-width: 640px) {
  .verify-card {
    padding: 2rem 1.5rem;
  }

  .otp-input {
    font-size: 1.5rem;
    letter-spacing: 0.3rem;
  }
}
</style>
