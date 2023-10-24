import { createRouter, createWebHistory } from 'vue-router'
import store from "@/plugins/app/_config/store"

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
      component: () => import('@/plugins/app@auth/login/login.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/auth/register',
      name: 'Register',
      component: () => import('@/plugins/app@auth/register/register.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/auth/forgot-password',
      name: 'Forgot Password',
      component: () => import('@/plugins/app@auth/forgot-password/forgot-password.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/auth/reset-password',
      name: 'Reset Password',
      component: () => import('@/plugins/app@auth/reset-password/reset-password.vue'),
      meta: { requiresAuth: false },
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

router.beforeEach((to, from, next) => {
	localStorage.setItem("ecommerce_user_lastSeen", Date())

	if (to.meta.requiresAuth === true) {
		if (!store.getters["auth/isLoggedIn"]) {
			return next({ name: "Login" })
		}

		return next()
	} else if (to.meta.requiresAuth === false) {
		if (store.getters["auth/isLoggedIn"]) {
			return next({ name: "Home" })
		}

		return next()
	}

	return next()
})

export default router
