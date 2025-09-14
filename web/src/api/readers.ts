import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Reader } from '@/types'

export const getPublications = () => http.get<Reader[]>(ENDPOINTS.READERS)

export const getPublication = (id: number) => http.get<Reader>(`${ENDPOINTS.READERS}/${id}`)
