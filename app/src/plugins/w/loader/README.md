# W / Alert
- This plugin will add global $loader variable, so you can easily show loaders anywhere
- This plugin automatically supports w/i18n for translations

# Required internal plugins
- w/loader

# Installation
1. Import in main.ts
```javascript
import wLoader from '@/plugins/w/loader'

const app = createApp(App)
	.use(wLoader)
```
2. If you have installed w/i18n (you have to import i18n first), all messages will be automatically translated

# Examples
- loader will add global $loader property (this.$loader).

```HTML
<ion-button :disabled="this.$loader.isLoading()" @click="forgotPassword()">Submit</button>
```

```javascript
async forgotPassword() {
	if (!(await this.v$.$validate())) return
	this.$loader.startLoading()

	try {
		await this.$store.dispatch('auth/forgotPassword', {email: this.form.email})
	} catch (error) {
		this.$toast.error(error)
	} finally {
		this.$loader.stopLoading()
	}
}
```