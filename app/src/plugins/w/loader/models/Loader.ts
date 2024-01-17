import { loadingController } from '@ionic/vue'
import { ref } from 'vue'

export class Loader {
	private i18n
	private loader = null
	private _isLoading = ref(false)

	constructor(i18n) {
		this.i18n = i18n?.vendorI18n?.global
	}

	public isLoading() {
		return this._isLoading.value
	}

	async startLoading(text = 'Loading') {
		this._isLoading.value = true

		this.loader = await loadingController
			.create({
				message: this.i18n.t(text)
			})

		this.loader.present()
	}

	stopLoading() {
		this._isLoading.value = false
		this.loader?.dismiss()
	}

	public vforSkelet(data, count) {
		if (data)
			return data

		return Array(count).fill(null)
	}
}

