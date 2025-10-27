import { defineStore } from 'pinia'
import { getPublications, getPublicationsTotal } from '@/api/publications'
import { getLoans, getLoansTotal } from '@/api/loans'
import { getReaders, getReadersTotal } from '@/api/readers'
import type { Publication, Loan, Reader } from '@/types'

export const useDataStore = defineStore('data', {
  state: () => ({
    publications: [] as Publication[],
    publications_total: 0,
    publications_pagination: { current_page: 1, per_page: 10, total_pages: 1 } as {
      current_page: number
      per_page: number
      total_pages: number
    },

    loans: [] as Loan[],
    loans_total: 0,
    loans_pagination: { current_page: 1, per_page: 10, total_pages: 1 } as {
      current_page: number
      per_page: number
      total_pages: number
    },

    readers: [] as Reader[],
    readers_total: 0,
    readers_pagination: { current_page: 1, per_page: 10, total_pages: 1 } as {
      current_page: number
      per_page: number
      total_pages: number
    },

    errorMessage: '' as string,
  }),

  actions: {
    async get_publications(page: number = 0, perpage: number = 10) {
      try {
        const { data } = await getPublications(page, perpage)
        this.publications = data.data // сохраняем данные
        this.publications_pagination = {
          current_page: data.current_page,
          per_page: data.per_page,
          total_pages: data.total_pages,
        }
        this.errorMessage = ''
        return data
      } catch (error: unknown) {
        console.error('Error fetching publications:', error)
        this.errorMessage = 'Ошибка загрузки публикаций'
        throw error
      }
    },

    async get_publications_total() {
      try {
        const { data } = await getPublicationsTotal()
        this.publications_total = data.total // сохраняем total
        this.errorMessage = ''
        return data.total
      } catch (error: unknown) {
        console.error('Error fetching publications total:', error)
        this.errorMessage = 'Ошибка загрузки общего количества публикаций'
        throw error
      }
    },

    async get_loans(page: number = 0, perpage: number = 10) {
      try {
        const { data } = await getLoans(page, perpage)
        this.loans = data.data
        this.loans_pagination = {
          current_page: data.current_page,
          per_page: data.per_page,
          total_pages: data.total_pages,
        }
        this.errorMessage = ''
        return data
      } catch (error: unknown) {
        console.error('Error fetching loans:', error)
        this.errorMessage = 'Ошибка загрузки выдач'
        throw error
      }
    },

    async get_loans_total() {
      try {
        const { data } = await getLoansTotal()
        this.loans_total = data.total
        this.errorMessage = ''
        return data.total
      } catch (error: unknown) {
        console.error('Error fetching loans total:', error)
        this.errorMessage = 'Ошибка загрузки общего количества выдач'
        throw error
      }
    },

    async get_readers(page: number = 0, perpage: number = 10) {
      try {
        const { data } = await getReaders(page, perpage)
        this.readers = data.data
        this.readers_pagination = {
          current_page: data.current_page,
          per_page: data.per_page,
          total_pages: data.total_pages,
        }
        this.errorMessage = ''
        return data
      } catch (error: unknown) {
        console.error('Error fetching readers:', error)
        this.errorMessage = 'Ошибка загрузки читателей'
        throw error
      }
    },

    async get_readers_total() {
      try {
        const { data } = await getReadersTotal()
        this.readers_total = data.total
        this.errorMessage = ''
        return data.total
      } catch (error: unknown) {
        console.error('Error fetching readers total:', error)
        this.errorMessage = 'Ошибка загрузки общего количества читателей'
        throw error
      }
    },

    async initialize() {
      await Promise.all([
        this.get_publications_total(),
        this.get_loans_total(),
        this.get_readers_total(),
      ])
    },
  },
})
