import { App } 		from 'vue'
import { Options } 	from './types'
import { Loader } 	from './models/Loader'

export default {
	install: (app: App, options: Options = {}) => {
		if (options && options.disabled == true) return

		app.config.globalProperties.$loader = new Loader(app.config.globalProperties.$w18n)
		app.config.globalProperties.$skelet = app.config.globalProperties.$loader.vforSkelet
	}
}