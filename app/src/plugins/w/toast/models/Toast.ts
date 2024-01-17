import { toastController } from '@ionic/vue'
import { ToastOptions} from '@ionic/core/dist/types/components/toast/toast-interface'
import utils from '../utils/toast.utils'

/**
 * @see [Documentation]{@link (https://ionicframework.com/docs/api/toast)} for more information about the toast.
 */
export class Toast {

	private readonly MINIMUM_DESKTOP_WIDTH = 768

	private i18n

	constructor(i18n) {
		this.i18n = i18n?.vendorI18n?.global
	}

	/**
	 * Creates success toast.
	 * @param message - (Optional) Message to be displayed in the toast.
	 * @param verticalPosition - (Optional) Vertical position of the toast. Default: 'top'.
	 * @param horizontalPosition - (Optional) Horizontal position of the toast. Default: 'right'.
	 */
	public async success(message = 'Success', verticalPosition: 'top' | 'middle' | 'bottom' = 'top', horizontalPosition: 'left' | 'center' | 'right' = 'right') {
		const toast = await toastController.create({
			message: utils.parseAndTranslate(message, this.i18n),
			color: 'success',
			position: verticalPosition,
			cssClass: `w-toast w-${verticalPosition} ${horizontalPosition && window.innerWidth >= this.MINIMUM_DESKTOP_WIDTH ? `w-${horizontalPosition}` : ''}`,
			duration: 2000
		})

		await toast.present()
	}

	/**
	 * Creates warning toast.
	 * @param message - (Optional) Message to be displayed in the toast.
	 * @param verticalPosition - (Optional) Vertical position of the toast. Default: 'top'.
	 * @param horizontalPosition - (Optional) Horizontal position of the toast. Default: 'right'.
	 */
	public async warning(message = 'Warning', verticalPosition: 'top' | 'middle' | 'bottom' = 'top', horizontalPosition: 'left' | 'center' | 'right' = 'right') {
		const toast = await toastController.create({
			message: utils.parseAndTranslate(message, this.i18n),
			color: 'warning',
			position: verticalPosition,
			cssClass: `w-toast w-${verticalPosition} ${horizontalPosition && window.innerWidth >= this.MINIMUM_DESKTOP_WIDTH ? `w-${horizontalPosition}` : ''}`,
			duration: 2000,
		})

		await toast.present()
	}

	/**
	 * Creates error toast.
	 * @param message - (Optional) Message to be displayed in the toast.
	 * @param verticalPosition - (Optional) Vertical position of the toast. Default: 'top'.
	 * @param horizontalPosition - (Optional) Horizontal position of the toast. Default: 'right'.
	 */
	public async error(message = 'Error', verticalPosition: 'top' | 'middle' | 'bottom' = 'top', horizontalPosition: 'left' | 'center' | 'right' = 'right') {
		const toast = await toastController.create({
			message: utils.parseAndTranslate(message, this.i18n),
			color: 'danger',
			position: verticalPosition,
			cssClass: `w-toast w-${verticalPosition} ${horizontalPosition && window.innerWidth >= this.MINIMUM_DESKTOP_WIDTH ? `w-${horizontalPosition}` : ''}`,
			duration: 2000
		})

		await toast.present()
	}

	/**
	 * Creates custom toast.
	 * @param options - (Optional) Options to be displayed in the toast. See [Documentation]{@link (https://ionicframework.com/docs/api/toast#toastoptions)} for more information about the toast options.
	 */
	public async custom(options: ToastOptions) {
		const toast = await toastController.create(options)
		await toast.present()
	}
}
