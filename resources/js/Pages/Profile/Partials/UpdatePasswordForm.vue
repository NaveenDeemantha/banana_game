<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="form-section">
        <form @submit.prevent="updatePassword" class="form-container">
            <div class="form-group">
                <InputLabel for="current_password" value="Current Password" class="form-label" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="form-input"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="error-message"
                />
            </div>

            <div class="form-group">
                <InputLabel for="password" value="New Password" class="form-label" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="form-input"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="error-message" />
            </div>

            <div class="form-group">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                    class="form-label"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="form-input"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="error-message"
                />
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
