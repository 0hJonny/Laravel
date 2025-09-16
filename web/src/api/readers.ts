import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Reader } from '@/types'

export const getReaders = () => http.get<Reader[]>(ENDPOINTS.READERS)

export const getReader = (id: number) => http.get<Reader>(`${ENDPOINTS.READERS}/${id}`)
