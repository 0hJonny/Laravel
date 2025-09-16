<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { getReaders } from '@/api/readers'
import type { Reader } from '@/types'

const readers = ref<Reader[]>([])
onMounted(async () => {
  const { data } = await getReaders()
  readers.value = data
})
</script>

<template>
  <section>
    <h2>Readers</h2>
    <pre>{{ readers }}</pre>
  </section>
</template>
