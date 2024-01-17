export default {
	parseAndTranslate(data, i18n) {
		const errorsArray = this._parseToArrayOfStrings(data, i18n)

		return errorsArray.map(error => this._translate(error, i18n))
	},

	_parseToArrayOfStrings(data, i18n) {
		if (typeof data == 'string') {
			return [this._translate(data, i18n)]
		}
		
		if (data && data.error && typeof data.error == 'string') {
			return [this._translate(data.error, i18n)]
		}
		
		if (data && data.error && typeof data.error == 'object') {
			return Object.values(this._translate(data.error, i18n))
		}
		
		if (data.data && data.data.error && typeof data.data.error == 'string') {
			return [this._translate(data.data.error, i18n)]
		}
		
		if (data && data.data && data.data.error && typeof data.data.error == 'object') {
			return Object.values(data.data.error).map(error => this._translate(error[0], i18n) + ' ')
		}
		
		if (data.statusText) {
			return [this._translate(data.statusText)]
		}

		return [data]
	},

	_translate(value, i18n) {
		if (!i18n) return value

		return i18n.t(value)
	}
}