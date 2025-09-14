import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Publication } from '@/types'

export const getPublications = () => http.get<Publication[]>(ENDPOINTS.PUBLICATIONS)

export const getPublication = (id: number) =>
  http.get<Publication>(`${ENDPOINTS.PUBLICATIONS}/${id}`)
