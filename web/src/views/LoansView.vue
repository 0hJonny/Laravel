<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { getLoans } from '@/api/loans'
import type { Loan } from '@/types'

const loans = ref<Loan[]>([])
onMounted(async () => {
  const { data } = await getLoans()
  loans.value = data
})
</script>

<template>
  <section>
    <h2>Loans</h2>
    <pre>{{ loans }}</pre>
  </section>
</template>
