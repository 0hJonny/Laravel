<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { useAuthStore } from '@/stores/authStore'

const email = ref('')
const password = ref('')

const auth = useAuthStore()

const isAuthenticated = computed(() => auth.isAuthenticated)
const userName = computed(() => auth.user?.user_name ?? 'пользователь')
const authError = computed(() => auth.errorMessage)

const login = () => auth.login({ email: email.value, password: password.value })
const logout = () => auth.logout()

onMounted(() => {
  if (localStorage.getItem('token')) auth.isAuthenticated = true
})
</script>

<template>
  <header>
    <!-- Навигационная «шапка» -->
    <h1>Vue вход</h1>

    <!-- Авторизованный пользователь -->
    <div v-if="isAuthenticated">
      <p>Здравствуйте, {{ userName }}!</p>
      <button @click="logout">Выйти</button>
    </div>

    <!-- Форма логина -->
    <form v-else @submit.prevent="login">
      <label
        >Email
        <input v-model="email" type="email" required />
      </label>

      <label
        >Пароль
        <input v-model="password" type="password" required />
      </label>

      <button type="submit">Войти</button>
      <p v-if="authError" class="error">{{ authError }}</p>
    </form>
  </header>
</template>

<style scoped>
header {
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
