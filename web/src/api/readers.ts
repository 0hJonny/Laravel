import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Reader } from '@/types'

export const getReaders = (page: number = 0, perpage: number = 10) =>
  http.get<{ data: Reader[]; current_page: number; per_page: number; total_pages: number }>(
    `${ENDPOINTS.READERS}?page=${page}&perpage=${perpage}`,
  )

export const getReadersTotal = () => http.get<{ total: number }>(ENDPOINTS.READERS_TOTAL)

export const getReader = (id: number) => http.get<Reader>(`${ENDPOINTS.READERS}/${id}`)
