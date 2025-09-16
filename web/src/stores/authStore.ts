import { defineStore } from 'pinia'
import { http } from '@/api/http'
import { ENDPOINTS } from '@/api/endpoints'
import type { LoginResponse, User } from '@/types'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') as string | null,
    user: null as User | null,
    isAuthenticated: !!localStorage.getItem('token'),
    errorMessage: '',
  }),

  actions: {
    async initialize() {
      if (this.token && !this.user) await this.getUser()
    },

    async getUser() {
      if (!this.token) return
      try {
        const { data } = await http.get<User>(ENDPOINTS.USERDATA, {
          headers: { Authorization: `Bearer ${this.token}` },
        })
        this.user = data
        this.isAuthenticated = true
      } catch {
        this.logout()
      }
    },

    async login(credentials: { email: string; password: string; device?: string }) {
      try {
        const { data } = await http.post<LoginResponse>(ENDPOINTS.LOGIN, credentials)
        this.token = data.token
        this.user = data.user
        this.isAuthenticated = true
        this.errorMessage = ''

        localStorage.setItem('token', data.token)
      } catch (e: unknown) {
        console.error(e)
        this.errorMessage = `Неверные учётные данные.`
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
