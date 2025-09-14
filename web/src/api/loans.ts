import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Loan } from '@/types'

export const getPublications = () => http.get<Loan[]>(ENDPOINTS.LOANS)

export const getPublication = (id: number) => http.get<Loan>(`${ENDPOINTS.LOANS}/${id}`)
