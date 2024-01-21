import { createRouter, createWebHistory } from 'vue-router'
import store from "@/plugins/app/_config/store"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('@/plugins/app@emarketplace/storefront/storefront.vue')
    },
    {
      path: '/listings/',
      name: 'Listings',
      component: () => import('@/plugins/app@emarketplace/listings/listings.vue')
    },
    {
      path: '/listing/:id',
      name: 'Listing',
      component: () => import('@/plugins/app@emarketplace/listing/listing.vue')
    },
    {
      path: '/new-listing',
      name: 'New Listing',
      component: () => import('@/plugins/app@emarketplace/new-listing/new-listing.vue'),
      meta: { requiresAuth: true }
    },
    {
      path: '/my-listings',
      name: 'My Listings',
      component: () => import('@/plugins/app@emarketplace/my-listings/my-listings.vue'),
      meta: { requiresAuth: true }
    },
    // Auth
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
    }
  ]
})

router.beforeEach((to, from, next) => {
	localStorage.setItem("emarketplace_user_lastSeen", Date())

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
