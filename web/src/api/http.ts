import axios from 'axios'
import { API_BASE_URL } from './endpoints'

export const http = axios.create({
  baseURL: `${API_BASE_URL}/api`,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
})

http.interceptors.response.use(
  (r) => r,
  (err) => {
    console.error('Axios error:', {
      message: err.message,
      code: err.code,
      url: err.config?.url,
    })
    return Promise.reject(err)
  },
)
