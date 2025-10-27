import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Publication } from '@/types'

export const getPublications = (page: number = 0, perpage: number = 10) =>
  http.get<{ data: Publication[]; current_page: number; per_page: number; total_pages: number }>(
    `${ENDPOINTS.PUBLICATIONS}?page=${page}&perpage=${perpage}`,
  )

export const getPublicationsTotal = () => http.get<{ total: number }>(ENDPOINTS.PUBLICATIONS_TOTAL)

export const getPublication = (id: number) =>
  http.get<Publication>(`${ENDPOINTS.PUBLICATIONS}/${id}`)
