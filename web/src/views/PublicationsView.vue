<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { getPublications } from '@/api/publications'
import type { Publication } from '@/types'

const publications = ref<Publication[]>([])
onMounted(async () => {
  const { data } = await getPublications()
  publications.value = data
})
</script>

<template>
  <section>
    <h2>Publications</h2>
    <pre>{{ publications }}</pre>
  </section>
</template>
