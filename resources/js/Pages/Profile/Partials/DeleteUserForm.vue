<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="form-section">
        <div class="warning-box">
            <p class="warning-text">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </p>
        </div>

        <DangerButton @click="confirmUserDeletion" class="delete-btn">Delete Account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="modal-content">
                <h2 class="modal-title">
                    <span class="modal-icon">⚠️</span>
                    Are you sure you want to delete your account?
                </h2>

                <p class="modal-text">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Please enter your password to
                    confirm you would like to permanently delete your account.
                </p>

                <div class="modal-input-group">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="modal-input"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="error-message" />
                </div>

                <div class="modal-actions">
                    <SecondaryButton @click="closeModal" class="cancel-btn">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="confirm-delete-btn"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>

<style scoped>
.form-section {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.warning-box {
  background-color: #fee2e2;
  border: 2px solid #fecaca;
  border-radius: 0.5rem;
  padding: 0.75rem;
}

.warning-text {
  color: #991b1b;
  font-size: 0.875rem;
  line-height: 1.5;
}

.delete-btn {
  padding: 0.625rem 1.5rem;
  background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
  color: #FFFFFF;
  border-radius: 0.5rem;
  font-weight: 600;
  transition: all 0.3s;
  align-self: flex-start;
}

.delete-btn:hover {
  background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
  transform: scale(1.05);
}

.modal-content {
  padding: 1.5rem;
}

.modal-title {
  font-size: 1.125rem;
  font-weight: 700;
  color: #dc2626;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.modal-icon {
  font-size: 1.5rem;
}

.modal-text {
  color: #991b1b;
  font-size: 0.875rem;
  margin-bottom: 1.5rem;
  line-height: 1.5;
}

.modal-input-group {
  margin-bottom: 1.5rem;
}

.modal-input {
  width: 75%;
  padding: 0.625rem;
  border: 2px solid #fecaca;
  border-radius: 0.5rem;
  background-color: #FFFFFF;
  transition: all 0.3s;
}

.modal-input:focus {
  border-color: #ef4444;
  outline: none;
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.error-message {
  color: #dc2626;
  font-size: 0.875rem;
  margin-top: 0.5rem;
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: 0.75rem;
}

.cancel-btn {
  padding: 0.625rem 1.5rem;
  background-color: #f3f4f6;
  color: #374151;
  border-radius: 0.5rem;
  font-weight: 500;
  transition: all 0.3s;
}

.cancel-btn:hover {
  background-color: #e5e7eb;
}

.confirm-delete-btn {
  margin-left: 0.75rem;
  padding: 0.625rem 1.5rem;
  background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
  color: #FFFFFF;
  border-radius: 0.5rem;
  font-weight: 600;
  transition: all 0.3s;
}

.confirm-delete-btn:hover {
  background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
}

.confirm-delete-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
