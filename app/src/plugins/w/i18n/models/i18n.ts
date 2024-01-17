import { Language, Options } 	from "../types"
import { Ref, ref } 			from 'vue'
import axios 					from 'axios'
import { createI18n, I18n as I18nType } from 'vue-i18n'
import { Preferences } 				from '@capacitor/preferences'


export class I18n {
	public currentLanguage: Ref<Language> = ref();
	public availableLanguages: Language[];
	public vendorI18n: I18nType
	public defaultLanguage: Language | null;

	private languageKey: string;

	constructor(properties: Options) {
		this.availableLanguages = properties.languages || []
		this.defaultLanguage	= properties.languages.find(language => language.value == properties.defaultLanguage)
		this.languageKey		= properties.languageKey || 'w18n_language'

		this.vendorI18n			= createI18n({
			legacy: true,
			fallbackLocale: this.defaultLanguage.value,
			messages: this._loadLocaleMessages(),
			missing: this._missingTranslation,
			postTranslation: this._postTranslation,
		})

		this.initCurrentLanguage()
	}

	public async initCurrentLanguage() {
		const { value } = await Preferences.get({ key: this.languageKey })

		if (value) {
			this.currentLanguage.value = JSON.parse(value)
		} else if (this.defaultLanguage) {
			this.currentLanguage.value = this.defaultLanguage
		} else if (this.availableLanguages[0]) {
			this.currentLanguage.value = this.availableLanguages[0]
		} else {
			return console.error('[w18n] Could not init current language')
		}

		const availableLanguages = {}

		this.availableLanguages.forEach(language => {
			availableLanguages[language.value] = language.title
		})

		this.changeLanguage(this.currentLanguage.value)
		// Translations.setup(this.currentLanguage.value.value, availableLanguages)

		this._addAxiosHeaders()
	}

	public changeLanguage(language: Language) {
		this.currentLanguage.value = language
		this._addAxiosHeaders()

		Preferences.set({
			key: this.languageKey,
			value: JSON.stringify(language)
		})

		this.vendorI18n.global.locale = language.value
	}


	private _addAxiosHeaders() {
		axios.interceptors.request.use(config => {
			if (this.currentLanguage.value && this.currentLanguage.value.value) {
				config.headers['Accept-Language'] = this.currentLanguage.value.value
			}

			return config
		})
	}

	public _loadLocaleMessages(path = '@/locales') {
		let locales

		if (path != '@/locales') {
			return console.error('[w18n] Vite version of this plugin currently does not allow to change path.')
		}

		try {
			locales = import.meta.glob('@/plugins/app/_locales/*.json', { eager: true })
		} catch (error) {
			console.warn('[@wezeo/i18n] Could not initialize i18n. Missing folder /src/plugins/app/_locales.')
			return {}
		}

		const messages: {[key: string]: {[key: string]: string}} = {}


		Object.keys(locales).forEach((key) => {
			const matched = key.match(/([A-Za-z0-9-_]+)\./i)
			if (matched && matched.length > 1) {
				const locale = matched[1]

				messages[locale] = locales[key]
			}
		})

		return messages
	}


	private _missingTranslation = (locale, key, instance?, type?) => {
		return key
	}

	private _postTranslation = (translated) => {
		return translated
	}
}
