<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const email = ref('')
const password = ref('')

const auth = useAuthStore()
const router = useRouter()

const authError = computed(() => auth.errorMessage)

const login = async () => {
  await auth.login({ email: email.value, password: password.value })
  if (auth.isAuthenticated) router.push('/loans') // редирект после успеха
}
</script>

<template>
  <section>
    <h1>Вход</h1>
    <form @submit.prevent="login">
      <label>
        Email
        <input v-model="email" type="email" required />
      </label>
      <label>
        Пароль
        <input v-model="password" type="password" required />
      </label>
      <button type="submit">Войти</button>
      <p v-if="authError" class="error">{{ authError }}</p>
    </form>
  </section>
</template>

<style scoped>
section {
  max-width: 420px;
  margin: 60px auto;
  padding: 24px;
  border: 1px solid #ddd;
  border-radius: 8px;
  text-align: center;
}
label {
  display: block;
  margin: 12px 0;
}
input {
  width: 100%;
  padding: 6px 8px;
  margin-top: 4px;
}
button {
  margin-top: 12px;
}
.error {
  color: #c00;
  margin-top: 8px;
}
</style>
