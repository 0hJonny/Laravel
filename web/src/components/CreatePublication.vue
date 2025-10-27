<script setup lang="ts">
import { ref } from 'vue'
import { useDataStore } from '@/stores/dataStore'
import { useToast } from 'primevue/usetoast'
import { useRouter } from 'vue-router'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import Calendar from 'primevue/calendar'
import FileUpload from 'primevue/fileupload'
import Button from 'primevue/button'
import Toast from 'primevue/toast'

const dataStore = useDataStore()
const toast = useToast()
const router = useRouter()

const form = ref({
  publication_title: '',
  publication_author: '',
  publication_publisher: '',
  publication_date: '',
  publication_page: 0,
  publication_ISBN: '',
  publication_publication_language: 1,
})

const formFile = ref<File | null>(null)

const onFileSelect = (event: any) => {
  formFile.value = event.files[0]
}

const onFileRemove = () => {
  formFile.value = null
}

const formatSize = (bytes: number) => {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return Number((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

const submitForm = async () => {
  // Проверка файла
  if (!formFile.value) {
    toast.add({
      severity: 'warn',
      summary: 'Warning',
      detail: 'Please select cover image',
      life: 3000,
    })
    return
  }

  let dateString = ''
  if (!form.value.publication_date) {
    toast.add({
      severity: 'error',
      summary: 'Error',
      detail: 'Please select publication date',
      life: 3000,
    })
    return
  }

  const date = new Date(form.value.publication_date)
  if (isNaN(date.getTime())) {
    toast.add({ severity: 'error', summary: 'Error', detail: 'Invalid date selected', life: 3000 })
    return
  }

  // Форматирование: YYYY-MM-DD
  dateString = date.toISOString().split('T')[0]
  console.log('Formatted date:', dateString)

  if (
    !form.value.publication_title ||
    !form.value.publication_author ||
    !form.value.publication_publisher ||
    form.value.publication_page < 1 ||
    !form.value.publication_ISBN ||
    form.value.publication_ISBN.length !== 13
  ) {
    toast.add({
      severity: 'warn',
      summary: 'Warning',
      detail: 'Please fill all required fields correctly',
      life: 3000,
    })
    return
  }

  const formData = new FormData()
  formData.append('publication_title', form.value.publication_title)
  formData.append('publication_author', form.value.publication_author)
  formData.append('publication_publisher', form.value.publication_publisher)
  formData.append('publication_date', dateString)
  formData.append('publication_page', form.value.publication_page.toString())
  formData.append('publication_ISBN', form.value.publication_ISBN)
  formData.append(
    'publication_publication_language',
    form.value.publication_publication_language.toString(),
  )
  formData.append('publication_cover', formFile.value)

  console.log('FormData entries:')
  for (let [key, value] of formData.entries()) {
    console.log(`${key}:`, value)
  }

  try {
    dataStore.loading = true
    await dataStore.create_publication(formData)
    toast.add({
      severity: 'success',
      summary: 'Success',
      detail: 'Publication created!',
      life: 3000,
    })

    // Очистка формы после успеха
    form.value = {
      publication_title: '',
      publication_author: '',
      publication_publisher: '',
      publication_date: '',
      publication_page: 0,
      publication_ISBN: '',
      publication_publication_language: 1,
    }
    formFile.value = null
    router.push('/publications')
  } catch (error) {
    console.error('Submit error:', error)
    const severity =
      dataStore.errorCode === 1 ? 'warn' : dataStore.errorCode === 2 ? 'info' : 'error'
    toast.add({
      severity,
      summary: 'Error',
      detail: dataStore.errorMessage || 'Unknown error',
      life: 5000,
    })
  } finally {
    dataStore.loading = false
  }
}
</script>

<template>
  <div class="p-4 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Create Publication</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <div class="field">
        <label for="title" class="block mb-2">Title</label>
        <InputText id="title" v-model="form.publication_title" class="w-full" required />
      </div>

      <div class="field">
        <label for="author" class="block mb-2">Author</label>
        <InputText id="author" v-model="form.publication_author" class="w-full" required />
      </div>

      <div class="field">
        <label for="publisher" class="block mb-2">Publisher</label>
        <InputText id="publisher" v-model="form.publication_publisher" class="w-full" required />
      </div>

      <div class="field">
        <label for="date" class="block mb-2">Publication Date</label>
        <Calendar
          id="date"
          v-model="form.publication_date"
          date-format="yy-mm-dd"
          class="w-full"
          required
        />
      </div>

      <div class="field">
        <label for="pages" class="block mb-2">Pages</label>
        <InputNumber id="pages" v-model="form.publication_page" :min="1" class="w-full" required />
      </div>

      <div class="field">
        <label for="isbn" class="block mb-2">ISBN (13 digits)</label>
        <InputText
          id="isbn"
          v-model="form.publication_ISBN"
          maxlength="13"
          class="w-full"
          required
        />
      </div>

      <div class="field">
        <label for="language" class="block mb-2">Language ID</label>
        <InputNumber
          id="language"
          v-model="form.publication_publication_language"
          :min="1"
          class="w-full"
          required
        />
      </div>

      <div class="field">
        <label class="block mb-2">Cover Image</label>
        <FileUpload
          mode="advanced"
          :max-file-size="5120000"
          accept="image/*"
          :auto-upload="false"
          @select="onFileSelect"
          @remove="onFileRemove"
          :show-upload-button="false"
          :show-cancel-button="!!formFile"
          class="w-full"
        >
          <template #empty>
            <p>Drag and drop or click to select cover image</p>
          </template>
        </FileUpload>
        <p v-if="formFile" class="text-sm mt-2">
          Selected: {{ formFile.name }} ({{ formatSize(formFile.size) }})
        </p>
      </div>

      <Button type="submit" label="Create Publication" :loading="dataStore.loading" class="mt-4" />
    </form>

    <Toast />
  </div>
</template>
