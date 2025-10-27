<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import type { Reader } from '@/types'

const dataStore = useDataStore()

const perpage = ref(10)
const offset = ref(0)
const currentPage = ref(0)

// Реактивные данные из store
const readers = computed(() => dataStore.readers)
const readersTotal = computed(() => dataStore.readers_total)
const loading = computed(() => dataStore.loading)

// Загрузка первой страницы
onMounted(async () => {
  await loadReaders(currentPage.value, perpage.value)
})

// Обработчик пагинации
const onPageChange = async (event: { first: number; rows: number }) => {
  offset.value = event.first
  const newPage = Math.floor(event.first / event.rows)
  perpage.value = event.rows
  currentPage.value = newPage

  await loadReaders(newPage, perpage.value)
}

// Метод загрузки
const loadReaders = async (page: number, perpage: number) => {
  await dataStore.get_readers(page, perpage)
}
</script>

<template>
  <section>
    <h2>Readers</h2>

    <DataTable
      :value="readers"
      :lazy="true"
      :loading="loading"
      :paginator="true"
      :rows="perpage"
      :rows-per-page-options="[2, 5, 10]"
      :total-records="readersTotal"
      @page="onPageChange"
      :first="offset"
      class="w-full"
      striped-rows
    >
      <!-- <Column field="reader_id" header="ID"></Column> -->
      <Column field="reader_user_id" header="User ID"></Column>
      <Column field="reader_name" header="Name"></Column>
      <Column field="reader_surname" header="Surname"></Column>
      <Column field="reader_middle_name" header="Middle Name"></Column>
      <!-- <Column field="created_at" header="Created"></Column> -->
    </DataTable>

    <p v-if="dataStore.errorMessage" class="text-red-500">{{ dataStore.errorMessage }}</p>
    <p>Всего записей: {{ readersTotal }}</p>
  </section>
</template>
