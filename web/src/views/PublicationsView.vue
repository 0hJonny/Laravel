<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import type { Publication } from '@/types'

const dataStore = useDataStore()

// Refs для пагинации (локальные)
const perpage = ref(10)
const offset = ref(0)
const currentPage = ref(0)

// Реактивные данные из store
const publications = computed(() => dataStore.publications)
const publicationsTotal = computed(() => dataStore.publications_total)
const loading = computed(() => dataStore.loading)

// Загрузка первой страницы
onMounted(async () => {
  await loadPublications(currentPage.value, perpage.value)
})

// Обработчик пагинации
const onPageChange = async (event: { first: number; rows: number }) => {
  offset.value = event.first
  const newPage = Math.floor(event.first / event.rows)
  perpage.value = event.rows
  currentPage.value = newPage

  await loadPublications(newPage, perpage.value) // загружаем в store
}

// Метод загрузки
const loadPublications = async (page: number, perpage: number) => {
  await dataStore.get_publications(page, perpage) // обновляет глобальный store
}
</script>

<template>
  <section>
    <h2>Publications</h2>

    <DataTable
      :value="publications"
      :lazy="true"
      :loading="loading"
      :paginator="true"
      :rows="perpage"
      :rows-per-page-options="[2, 5, 10]"
      :total-records="publicationsTotal"
      @page="onPageChange"
      :first="offset"
      class="w-full"
      striped-rows
    >
      <Column field="publication_id" header="ID"></Column>
      <Column field="publication_title" header="Title"></Column>
      <Column field="publication_author" header="Author"></Column>
      <Column field="publication_publisher" header="Publisher"></Column>
      <Column field="publication_date" header="Date"></Column>
      <Column field="publication_page" header="Pages"></Column>
      <Column field="publication_ISBN" header="ISBN"></Column>
      <Column field="publication_publication_language" header="Language"></Column>
      <Column field="created_at" header="Created"></Column>
    </DataTable>

    <p v-if="dataStore.errorMessage" class="text-red-500">{{ dataStore.errorMessage }}</p>
    <p>Всего записей: {{ publicationsTotal }}</p>
  </section>
</template>
