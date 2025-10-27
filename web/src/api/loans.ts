import { http } from './http'
import { ENDPOINTS } from './endpoints'
import type { Loan } from '@/types'

export const getLoans = (page: number = 0, perpage: number = 10) =>
  http.get<{ data: Loan[]; current_page: number; per_page: number; total_pages: number }>(
    `${ENDPOINTS.LOANS}?page=${page}&perpage=${perpage}`,
  )

export const getLoansTotal = () => http.get<{ total: number }>(ENDPOINTS.LOANS_TOTAL)

export const getLoan = (id: number) => http.get<Loan>(`${ENDPOINTS.LOANS}/${id}`)
