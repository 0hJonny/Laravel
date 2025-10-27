export const API_BASE_URL = import.meta.env.VITE_API_URL as string

// относительные пути Laravel-роутов
export const ENDPOINTS = {
  LOGIN: '/login',
  LOGOUT: '/logout',
  USERDATA: '/user',
  PUBLICATIONS: '/publications',
  CREATE_PUBLICATION: '/publications',
  PUBLICATIONS_TOTAL: '/publications_total',
  LOANS: '/loans',
  LOANS_TOTAL: '/loans_total',
  READERS: '/readers',
  READERS_TOTAL: '/readers_total',
}
