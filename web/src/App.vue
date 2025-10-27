<script setup lang="ts">
import { onMounted } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import { useDataStore } from '@/stores/dataStore'
import MenubarComponent from '@/components/AppMenubar.vue'

const auth = useAuthStore()
const dataStore = useDataStore()

onMounted(async () => {
  await auth.initialize()
  await dataStore.initialize()
})
</script>

<template>
  <div class="min-h-screen bg-surface-ground">
    <MenubarComponent />

    <div class="m-3">
      <RouterView />
    </div>
  </div>
</template>
