import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const Login = () => import('@/views/LoginView.vue')
const Loans = () => import('@/views/LoansView.vue')
const Publications = () => import('@/views/PublicationsView.vue')
const Readers = () => import('@/views/ReadersView.vue')

const routes: RouteRecordRaw[] = [
  { path: '/', redirect: '/loans' },
  { path: '/login', name: 'Login', component: Login },
  { path: '/loans', name: 'Loans', component: Loans, meta: { requiresAuth: true } },
  {
    path: '/publications',
    name: 'Publications',
    component: Publications,
    meta: { requiresAuth: true },
  },
  { path: '/readers', name: 'Readers', component: Readers, meta: { requiresAuth: true } },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to) => {
  const auth = useAuthStore()
  if (to.meta.requiresAuth && !auth.isAuthenticated) return { name: 'Login' }
})

export default router
