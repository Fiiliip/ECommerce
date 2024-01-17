export interface Language {
	value: string,
	title: string,
	flag?: string
}

export interface Options {
	languages: Language[],
	defaultLanguage: string,
	languageKey?: string,
	disabled?: boolean
}