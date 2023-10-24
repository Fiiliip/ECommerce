# W / Auth
- This plugin is used for managing logged user, and will automatically inject auth store to your main store.

# Required third-party plugins
- `npm i vuex@4 && npm i axios-auth-refresh`

# Required internal plugins
- w/axios

# Installation
1. Create store.ts in `@/plugins/app/_config/store.ts.ts` and initialize vuex store
2. Import `@/plugins/app/_config/store.ts.ts` in `main.ts`
3. Import w/auth in `main.ts`

# Installation example
- main.ts
```javascript
import store from '@/plugins/app/_config/store.ts'
import auth from '@/plugins/w/auth'

const app = createApp(App)
	.use(store)
	.use(auth)
```
- store.ts
```javascript
import { createStore } from 'vuex'

export default createStore({
	modules: {}
})
```
# Store actions
```javascript
this.$store.dispatch('auth/login', credentials)
this.$store.dispatch('auth/signup', credentials)
this.$store.dispatch('auth/logout')
this.$store.dispatch('auth/forgotPassword', credentials)
this.$store.dispatch('auth/resetPassword', credentials)
this.$store.dispatch('auth/refreshToken')
this.$store.dispatch('auth/userInfo')
this.$store.dispatch('auth/updateUserInfo', user)
```

# Store getters
```javascript
this.$store.getters['auth/isLoggedIn']
this.$store.getters['auth/user']
```