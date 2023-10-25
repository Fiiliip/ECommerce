import { App } 		from 'vue'
import { Options } 	from './types'
import emarketplace 	from './_store/emarketplace.store'

export default {
	install: (app: App, options: Options = {}) => {
		if (options && options.disabled == true) return

		if (!app.config.globalProperties.$store)
			return console.warn('[emarketplace] Could not initialize. App does not have vuex store added.')

		app.config.globalProperties.$store.registerModule('emarketplace', emarketplace)
	}
}