# W / i18n
- This plugin will add translations to your app
- It will automatically add language header to axios requests
# Required third-party plugins
`npm i vue-i18n@9.2.0-beta.22 && npm i vue-i18n-extract@1.2.3 && npm i @capacitor/preferences && npm i axios`

# Installation
1. Install all required plugins listed above
2. Create src/plugins/app/_locales/ folder
3. Create language files (see later in exmaples)
4. Configure available languages in main.ts  (see later in exmaples)
5. Install plugin `app.use(i18n, options)`  (see later in exmaples)

# Installation examples
1. Language file (sk.json)
```json
{
	"error": "chyba"
}
```
2. Language configuration and plugin install in `main.ts`
```javascript
import i18n from '@/plugins/w/i18n'
import { Options as WOptions } from '@/plugins/w/w/types'

const options: WOptions = {
	languages: [
		{title: "Slovenský", flag: "sk", value: "sk"},
		{title: "English", flag: "en", value: "en"}
	],
	defaultLanguage: 'sk'
}

const app = createApp(App)
  .use(i18n, options)
```

# Public functions and variables
- Plugin will add public $w18n variable (`this.$w18n`)
```javascript
public currentLanguage: Ref<Language> = ref();
public availableLanguages: Language[];
public vendorI18n: I18nType
public defaultLanguage: Language | null;

public changeLanguage(language: Language) {...}
```

# Interfaces
```javascript
export interface Language {
	value: string,
	title: string,
	flag?: string
}
```