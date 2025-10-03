<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Card from 'primevue/card'

const email = ref('')
const password = ref('')

const auth = useAuthStore()
const router = useRouter()

const authError = computed(() => auth.errorMessage)

const login = async () => {
  await auth.login({ email: email.value, password: password.value })
  if (auth.isAuthenticated) router.push('/loans')
}
</script>

<template>
  <div class="flex justify-center items-center min-h-screen">
    <Card class="w-full max-w-md">
      <template #title>
        <h1 class="text-center text-2xl font-bold">Вход</h1>
      </template>
      <template #content>
        <form @submit.prevent="login" class="flex flex-col gap-4">
          <div class="flex flex-col gap-2">
            <label for="email" class="font-semibold">Email</label>
            <InputText
              id="email"
              v-model="email"
              type="email"
              placeholder="Введите ваш email"
              required
              class="w-full"
            />
          </div>

          <div class="flex flex-col gap-2">
            <label for="password" class="font-semibold">Пароль</label>
            <InputText
              id="password"
              v-model="password"
              type="password"
              placeholder="Введите ваш пароль"
              required
              class="w-full"
            />
          </div>

          <p v-if="authError" class="text-red-500 text-sm mt-1 mb-0">
            {{ authError }}
          </p>

          <Button label="Войти" type="submit" class="w-full mt-4" />
        </form>
      </template>
    </Card>
  </div>
</template>
