import { App } 		from 'vue'
import { Options } 	from './types'
import { I18n } 	from './models/i18n'
import events 		from '@/plugins/w/events'

export default {
	install: (app: App, options: Options) => {
		if (options && options.disabled === true)
			return

		if (!options || !options.languages || !options.defaultLanguage)
			return console.warn('[@wezeo/i18n] Could not initialize i18n. Missing configuration options.')

		if (!app.config.globalProperties.eventBus) {
			app.use(events)
		}

		const i18n = new I18n(options)

		app.use(i18n.vendorI18n)
		app.config.globalProperties.$w18n = i18n
	}
}
