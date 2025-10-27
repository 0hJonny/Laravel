<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import { RouterLink } from 'vue-router'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button'

const dataStore = useDataStore()

const perpage = ref(10)
const offset = ref(0)
const currentPage = ref(0)

const publications = computed(() => dataStore.publications)
const publicationsTotal = computed(() => dataStore.publications_total)
const loading = computed(() => dataStore.loading)

onMounted(async () => {
  await loadPublications(currentPage.value, perpage.value)
})

const onPageChange = async (event: { first: number; rows: number }) => {
  offset.value = event.first
  const newPage = Math.floor(event.first / event.rows)
  perpage.value = event.rows
  currentPage.value = newPage
  await loadPublications(newPage, perpage.value)
}

const loadPublications = async (page: number, perpage: number) => {
  await dataStore.get_publications(page, perpage)
}

const handleImageError = (event: Event) => {
  ;(event.target as HTMLImageElement).src = `${import.meta.env.VITE_APP_S3_URL}/covers/default.png`
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
      <Column header="Cover">
        <template #body="slotProps">
          <img
            :src="slotProps.data.cover_url"
            alt="Cover"
            class="w-16 h-24 object-cover rounded border"
            @error="handleImageError"
          />
        </template>
      </Column>

      <Column field="publication_id" header="ID"></Column>
      <Column field="publication_title" header="Title"></Column>
      <Column field="publication_author" header="Author"></Column>
      <Column field="publication_publisher" header="Publisher"></Column>
      <Column field="publication_date" header="Date"></Column>
      <Column field="publication_page" header="Pages"></Column>
      <Column field="publication_ISBN" header="ISBN"></Column>
      <Column field="created_at" header="Created"></Column>

      <template #footer>
        <div class="flex justify-end p-3">
          <RouterLink to="/createPublication">
            <Button label="Create New Publication" icon="pi pi-plus" severity="success" />
          </RouterLink>
        </div>
      </template>
    </DataTable>

    <p v-if="dataStore.errorMessage" class="text-red-500">{{ dataStore.errorMessage }}</p>
    <p>Всего записей: {{ publicationsTotal }}</p>
  </section>
</template>
