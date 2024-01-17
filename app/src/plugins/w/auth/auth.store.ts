import axios from '@/plugins/w/axios/models/axios'
import './refreshExpired'

const authDuration = 60 * 60 * 1000 // 1 hour in milliseconds

if (localStorage.getItem('emarketplace_user_rememberMe') === 'false') {
	const userLastSeen = localStorage.getItem('emarketplace_user_lastSeen')
	const currentDate = new Date()

	// If time difference is bigger than value set in authDuration.
	if (userLastSeen && currentDate.getTime() - new Date(userLastSeen).getTime() > authDuration) {
		localStorage.removeItem('emarketplace_user_token')
		localStorage.removeItem('emarketplace_user')
	}
}

export default {
	namespaced: true,
	state: {
		status: '',
		_token: localStorage.getItem('emarketplace_user_token') || '',
		user: JSON.parse(localStorage.getItem('emarketplace_user') || '{}'),
	},
	mutations: {
		auth_request(state: any) {
			state.status = 'loading'
		},
		auth_success(state: any, data: any) {
			state.status = 'success'
			if (data.token) {
				state._token = data.token
				localStorage.setItem('emarketplace_user_token', data.token)
			}

			if (data.user) {
				state.user = data.user
				localStorage.setItem('emarketplace_user', JSON.stringify(data.user))
			}
		},
		auth_error(state: any) {
			state.status = 'error'
			state._token = ''
			localStorage.removeItem('emarketplace_user_token')
			localStorage.removeItem('emarketplace_user')
		},
		logout(state: any) {
			state.status = ''
			state._token = ''
			state.user = null

			localStorage.removeItem('emarketplace_user_token')
			localStorage.removeItem('emarketplace_user')

			window.location.reload()
		}
	},
	actions: {
		login({commit}: {commit: any}, credentials: any) {
			return new Promise((resolve, reject) => {
				commit('auth_request')

				axios.post_data('/api/v1/auth/login', credentials)
					.then((response: any) => {
						const token = response.token
						const user = response.user

						commit('auth_success', {
							token: token,
							user: user
						})

						resolve(response)
					}).catch(error => {
						console.log(error)
						commit('auth_error')
						reject(error)
					})
			})
		},
		signup({commit }: {commit: any}, credentials: any) {
			return new Promise((resolve, reject) => {
				commit('auth_request')

				axios.post_data('/api/v1/auth/signup', credentials)
					.then((response: any) => {
						const token = response.token
						const user = response.user

						commit('auth_success', {
							token: token,
							user: user
						})

						resolve(response)
					}).catch(error => {
						commit('auth_error')
						reject(error)
					})
			})
		},
		logout({commit}: {commit: any}) {
			return new Promise((resolve) => {
				axios.post_auth_data('/api/v1/auth/invalidate')
					.finally(() => {
						commit('logout')
						resolve(null)
					})
			})
		},
		forgotPassword({}, credentials: any) {
			return new Promise((resolve, reject) => {
				axios.post_auth_data('/api/v1/auth/forgot', credentials)
					.then(response => resolve(response))
					.catch(error => reject(error))
			})
		},
		resetPassword({}, credentials: any) {
			return new Promise((resolve, reject) => {
				axios.post_auth_data('/api/v1/auth/reset', credentials)
					.then(response => resolve(response))
					.catch(error => reject(error))
			})
		},
		async refreshToken({commit}: {commit: any}) {
			try {
				const response: any = await axios.post_auth_data('/api/v1/auth/refresh')

				const token = response.token
				const user = response.user

				commit('auth_success', {
					token: token,
					user: user
				})

				return token
			} catch (error) {
				commit('auth_error')
				console.error(error)
			}
		},
		async userInfo({commit}: {commit: any}) {
			return new Promise((resolve, reject) => {
				axios.get_auth_data('/api/v1/auth/info')
					.then((response: any) => {
						const user = response.user

						commit('auth_success', {
							user: user
						})

						resolve(user)
					}).catch(error => {
						reject(error)
					})
			})
		},
		updateUserInfo({commit}: {commit: any}, data: any) {
			return new Promise((resolve, reject) => {
				axios.post_auth_data('/api/v1/auth/info', data)
					.then((response: any) => {
						const user = response.user

						commit('auth_success', {
							user: user
						})

						resolve(user)
					}).catch(error => {
						reject(error)
					})
			})
		},
	},
	getters: {
		isLoggedIn: (state: any) =>  {
			return !!state._token
		},
		user: (state: any) => {
			return state.user
		},
		token: (state: any) => {
			return state._token
		}
	}
}