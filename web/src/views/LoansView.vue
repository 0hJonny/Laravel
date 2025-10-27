<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import type { Loan } from '@/types'

const dataStore = useDataStore()

const perpage = ref(10)
const offset = ref(0)
const currentPage = ref(0)

const loans = computed(() => dataStore.loans)
const loansTotal = computed(() => dataStore.loans_total)
const loading = computed(() => dataStore.loading)

onMounted(async () => {
  await loadLoans(currentPage.value, perpage.value)
})

// Обработчик пагинации
const onPageChange = async (event: { first: number; rows: number }) => {
  offset.value = event.first
  const newPage = Math.floor(event.first / event.rows)
  perpage.value = event.rows
  currentPage.value = newPage

  await loadLoans(newPage, perpage.value)
}

const loadLoans = async (page: number, perpage: number) => {
  await dataStore.get_loans(page, perpage)
}

// Кастомная функция для отображения полного имени читателя
const renderReaderName = (loan: Loan) => {
  if (!loan.reader) return 'N/A' // если нет связи
  const parts = [loan.reader.reader_name, loan.reader.reader_surname]
  if (loan.reader.reader_middle_name) {
    parts.push(loan.reader.reader_middle_name)
  }
  return parts.filter(Boolean).join(' ') // space между (name + surname + middle)
}
</script>

<template>
  <section>
    <h2>Loans</h2>

    <DataTable
      :value="loans"
      :lazy="true"
      :loading="loading"
      :paginator="true"
      :rows="perpage"
      :rows-per-page-options="[2, 5, 10]"
      :total-records="loansTotal"
      @page="onPageChange"
      :first="offset"
      class="w-full"
      striped-rows
    >
      <Column field="loan_id" header="ID"></Column>

      <Column field="copy.publication.publication_title" header="Book Title"></Column>

      <Column header="Reader">
        <template #body="slotProps">
          {{ renderReaderName(slotProps.data) }}
        </template>
      </Column>

      <Column field="loan_date" header="Loan Date"></Column>
      <Column field="loan_return_date" header="Return Date"></Column>
      <Column field="loan_return_date_plan" header="Planned Return"></Column>
      <Column field="created_at" header="Created"></Column>
    </DataTable>

    <p v-if="dataStore.errorMessage" class="text-red-500">{{ dataStore.errorMessage }}</p>
    <p>Всего записей: {{ loansTotal }}</p>
  </section>
</template>
