import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Loan } from '@/types'

export const getLoans = () => http.get<Loan[]>(ENDPOINTS.LOANS)

export const getLoan = (id: number) => http.get<Loan>(`${ENDPOINTS.LOANS}/${id}`)
