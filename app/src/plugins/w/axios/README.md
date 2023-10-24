# W / Axios
- This plugin will add axios (this.$axios) with custom functions
# Required internal plugins
- w/auth
# Installation
1. Install plugin in `main.ts`
```javascript
import axios from '@/plugins/w/axios'

const app = createApp(App)
	.use(auth)
	.use(axios)
```
2. Create `.env` in app root directory
3. Add `VITE_APP_AXIOS_URL=defaultBaseUrl` to `.env`

# Examples
1. Call without authorization header
```javascript
this.$axios.get('/api/v1/courses')
```
2. Call with authorization header
```javascript
this.$axios.get_auth('/api/v1/courses')
```
3. Call that will return directly response.data.data
```javascript
this.$axios.get_data('/api/v1/courses')
this.$axios.get_auth_data('/api/v1/courses')
```

# Public functions
```javascript
async get(url: string, config?: any)
async get_data(url: string, config?: any)
async get_auth(url: string, config?: any)
async get_auth_data(url: string, config?: any)

async post(url: string, config?: any)
async post_data(url: string, config?: any)
async post_auth(url: string, config?: any)
async post_auth_data(url: string, config?: any)

async patch(url: string, config?: any)
async patch_data(url: string, config?: any)
async patch_auth(url: string, config?: any)
async patch_auth_data(url: string, config?: any)

async delete(url: string, config?: any)
async delete_data(url: string, config?: any)
async delete_auth(url: string, config?: any)
async delete_auth_data(url: string, config?: any)
```