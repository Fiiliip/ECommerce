import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('@/plugins/app@ecommerce/storefront/storefront.vue')
    },
    {
      path: '/auth/login',
      name: 'Login',
      component: () => import('@/plugins/app@auth/login/login.vue')
    },
    {
      path: '/auth/register',
      name: 'Register',
      component: () => import('@/plugins/app@auth/register/register.vue')
    },
    {
      path: '/auth/forgot-password',
      name: 'Forgot Password',
      component: () => import('@/plugins/app@auth/forgot-password/forgot-password.vue')
    },
    {
      path: '/auth/reset-password',
      name: 'Reset Password',
      component: () => import('@/plugins/app@auth/reset-password/reset-password.vue')
    },
    {
      path: '/category/:slug',
      name: 'Category',
      component: () => import('@/plugins/app@ecommerce/category/category.vue')
    },
    {
      path: '/product/:id',
      name: 'Product',
      component: () => import('@/plugins/app@ecommerce/product/product.vue')
    }
  ]
})

export default router
