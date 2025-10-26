export const API_BASE_URL = import.meta.env.VITE_API_URL as string

// относительные пути Laravel-роутов
export const ENDPOINTS = {
  LOGIN: '/login',
  LOGOUT: '/logout',
  USERDATA: '/user',
  PUBLICATIONS: '/publications',
  READERS: '/readers',
  LOANS: '/loans',
}
