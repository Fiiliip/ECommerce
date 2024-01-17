import { Options } 	from './types'
import { Toast } from "./models/Toast"

export default {
	install: (app, options: Options = {}) => {
		if (options && options.disabled === true) return
		
		app.config.globalProperties.$toast = new Toast(app.config.globalProperties.$w18n)
	}
}