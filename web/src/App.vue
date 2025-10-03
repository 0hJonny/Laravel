<script setup lang="ts">
import { onMounted } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import MenubarComponent from '@/components/AppMenubar.vue'

const auth = useAuthStore()

onMounted(async () => {
  await auth.initialize()
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
