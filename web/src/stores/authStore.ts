import { defineStore } from 'pinia'
import { http } from '@/api/http'
import { ENDPOINTS } from '@/api/endpoints'
import type { LoginResponse } from '@/types'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') as string | null,
    user: null as LoginResponse['user'] | null,
    isAuthenticated: !!localStorage.getItem('token'),
    errorMessage: '',
  }),

  actions: {
    async login(credentials: { email: string; password: string; device?: string }) {
      try {
        const { data } = await http.post<LoginResponse>(ENDPOINTS.LOGIN, credentials)
        this.token = data.token
        this.user = data.user
        this.isAuthenticated = true
        this.errorMessage = ''

        localStorage.setItem('token', data.token)
      } catch (e: unknown) {
        this.errorMessage = `Неверные учётные данные. ${e}`
        this.logout()
      }
    },

    async logout() {
      await http
        .post(ENDPOINTS.LOGOUT, null, {
          headers: { Authorization: `Bearer ${this.token}` },
        })
        .catch(() => {})
      localStorage.removeItem('token')
      this.token = null
      this.isAuthenticated = false
    },
  },
})
