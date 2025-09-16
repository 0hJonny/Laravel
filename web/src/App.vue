<script setup lang="ts">
import { computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const route = useRoute()
const router = useRouter()
const auth = useAuthStore()

const isAuthenticated = computed(() => auth.isAuthenticated)
const userName = computed(() => auth.user?.user_name ?? 'пользователь')

const isActive = (path: string) => route.path.startsWith(path)

const logout = async () => {
  await auth.logout()
  router.push('/login')
}
</script>

<template>
  <header>
    <h1>Библиотека</h1>

    <div v-if="isAuthenticated" class="auth-nav">
      <span>Здравствуйте, {{ userName }}!</span>
      <button @click="logout">Выход</button>
    </div>
    <RouterLink v-else to="/login">Вход</RouterLink>

    <nav v-if="isAuthenticated" class="tabs">
      <RouterLink to="/loans" class="tab" :class="{ active: isActive('/loans') }">Loans</RouterLink>
      <RouterLink to="/publications" class="tab" :class="{ active: isActive('/publications') }"
        >Publications</RouterLink
      >
      <RouterLink to="/readers" class="tab" :class="{ active: isActive('/readers') }"
        >Readers</RouterLink
      >
    </nav>
  </header>

  <RouterView />
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

.tabs {
  display: flex;
  gap: 12px;
  margin-bottom: 20px;
}
.tab {
  text-decoration: none;
  color: #555;
  padding: 6px 10px;
  border-radius: 6px;
}
.tab.active {
  background: #3b82f6;
  color: #fff;
}
.auth-nav {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
}
</style>
