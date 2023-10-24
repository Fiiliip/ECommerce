import store from '@/plugins/app/_config/store'
import axios from 'axios'
import createAuthRefreshInterceptor from 'axios-auth-refresh'

axios.interceptors.request.use(request => {
	request.headers['Authorization'] =  `Bearer ${store.getters['auth/token']}`
	return request
})

const refreshAuthLogic = failedRequest => store.dispatch('user/refreshToken').then(token => {
	failedRequest.response.config.headers.Authorization = `Bearer ${token}`
	return Promise.resolve()
})

createAuthRefreshInterceptor(axios, refreshAuthLogic)

