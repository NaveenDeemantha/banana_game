<template>
    <section class="form-section">
        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="form-container"
        >
            <div class="form-group">
                <InputLabel for="name" value="Name" class="form-label" />

                <TextInput
                    id="name"
                    type="text"
                    class="form-input"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="error-message" :message="form.errors.name" />
            </div>

            <div class="form-group">
                <InputLabel for="email" value="Email" class="form-label" />

                <TextInput
                    id="email"
                    type="email"
                    class="form-input"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="error-message" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null" class="verify-section">
                <p class="verify-text">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="verify-link"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="verify-success"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="form-actions">
                <PrimaryButton :disabled="form.processing" class="save-btn">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="success-text"
                    >
                        ✓ Saved successfully!
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<style scoped>
.form-section {
  padding: 1rem;
}

.form-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  color: #92400e;
  font-weight: 600;
  font-size: 0.875rem;
}

.form-input {
  width: 100%;
  padding: 0.625rem;
  border: 2px solid #fed7aa;
  border-radius: 0.5rem;
  background-color: #FFFFFF;
  transition: all 0.3s;
}

.form-input:focus {
  border-color: #fbbf24;
  outline: none;
  box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
}

.error-message {
  color: #dc2626;
  font-size: 0.875rem;
}

.verify-section {
  background-color: #fef3c7;
  border: 2px solid #fde68a;
  border-radius: 0.5rem;
  padding: 0.75rem;
}

.verify-text {
  color: #92400e;
  font-size: 0.875rem;
}

.verify-link {
  color: #ea580c;
  text-decoration: underline;
  font-weight: 500;
}

.verify-link:hover {
  color: #dc2626;
}

.verify-success {
  margin-top: 0.5rem;
  color: #16a34a;
  font-size: 0.875rem;
  font-weight: 500;
}

.form-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.save-btn {
  padding: 0.625rem 1.5rem;
  background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
  color: #FFFFFF;
  border-radius: 0.5rem;
  font-weight: 600;
  transition: all 0.3s;
}

.save-btn:hover {
  background: linear-gradient(135deg, #F59E0B 0%, #EA580C 100%);
  transform: scale(1.05);
}

.save-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.success-text {
  color: #16a34a;
  font-size: 0.875rem;
  font-weight: 500;
}
</style>
