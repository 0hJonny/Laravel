<script setup lang="ts">
import { computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

import Menubar from 'primevue/menubar'
import Button from 'primevue/button'
import Avatar from 'primevue/avatar'

const route = useRoute()
const router = useRouter()
const auth = useAuthStore()

const isAuthenticated = computed(() => auth.isAuthenticated)
const userName = computed(() => auth.user?.user_name ?? 'пользователь')

const isActive = (path: string) => route.path.startsWith(path)

const menuItems = computed(() => [
  {
    label: 'Loans',
    icon: 'pi pi-book',
    command: () => router.push('/loans'),
    class: isActive('/loans') ? 'p-menuitem-active' : '',
  },
  {
    label: 'Publications',
    icon: 'pi pi-file',
    command: () => router.push('/publications'),
    class: isActive('/publications') ? 'p-menuitem-active' : '',
  },
  {
    label: 'Readers',
    icon: 'pi pi-users',
    command: () => router.push('/readers'),
    class: isActive('/readers') ? 'p-menuitem-active' : '',
  },
])

const logout = async () => {
  await auth.logout()
  router.push('/login')
}

const goToLogin = () => {
  router.push('/login')
}
</script>

<template>
  <Menubar :model="isAuthenticated ? menuItems : []" class="border-round shadow-1 mb-3">
    <template #start>
      <div class="flex items-center gap-2">
        <i class="pi pi-book text-2xl text-primary"></i>
        <span class="font-bold text-xl">Библиотека</span>
      </div>
    </template>

    <template #end>
      <div v-if="isAuthenticated" class="flex items-center gap-2">
        <Avatar
          icon="pi pi-user"
          size="normal"
          class="mr-2"
          style="background-color: var(--primary-color); color: var(--primary-color-text)"
        />
        <span class="font-medium">Здравствуйте, {{ userName }}!</span>
        <Button
          label="Выход"
          icon="pi pi-sign-out"
          severity="secondary"
          size="small"
          @click="logout"
        />
      </div>

      <Button v-else label="Вход" icon="pi pi-sign-in" size="small" @click="goToLogin" />
    </template>
  </Menubar>
</template>

<style scoped>
:deep(.p-menuitem-active .p-menuitem-link) {
  background-color: var(--primary-color) !important;
  color: var(--primary-color-text) !important;
}

:deep(.p-menuitem-active .p-menuitem-link .p-menuitem-text) {
  color: var(--primary-color-text) !important;
}

:deep(.p-menuitem-active .p-menuitem-link .p-menuitem-icon) {
  color: var(--primary-color-text) !important;
}
</style>
