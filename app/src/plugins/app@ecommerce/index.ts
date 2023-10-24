import { App } 		from 'vue'
import { Options } 	from './types'
import ecommerce 	from './_store/ecommerce.store'

export default {
	install: (app: App, options: Options = {}) => {
		if (options && options.disabled == true) return

		if (!app.config.globalProperties.$store)
			return console.warn('[ecommerce] Could not initialize. App does not have vuex store added.')

		app.config.globalProperties.$store.registerModule('ecommerce', ecommerce)
	}
}