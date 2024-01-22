import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import { IonicVue } from '@ionic/vue'

import store from '@/plugins/app/_config/store'
import auth from '@/plugins/w/auth'
import axios from '@/plugins/w/axios'
import mocks from '@/plugins/w/moxios'
import i18n from '@/plugins/w/i18n'
import wToast from '@/plugins/w/toast'
import wLoader from '@/plugins/w/loader'
import emarketplace from '@/plugins/app@emarketplace'

import EMarketplaceMixin from '@/plugins/app@emarketplace/_mixins/emarketplace.mixin'

import '@/plugins/app/_themes/index.sass'
import '@ionic/vue/css/core.css'

const app = createApp(App)
    .use(router)
    .use(IonicVue)
    .use(store)
    .use(auth)
    .use(axios)
    .use(mocks, {
        routes: {
            'GET api/v1/mall/categories': false,
            'GET api/v1/mall/listings': false,
            'GET api/v1/mall/listing/1': false,
        }
    })
    .use(i18n, {
        defaultLanguage: 'sk',
        languages: [
            { title: 'Slovenský', flag: 'sk', value: 'sk' },
            { title: 'English', flag: 'en', value: 'en' }
        ],
    })
    .use(wToast)
    .use(wLoader)
    .use(emarketplace)

app.mixin(EMarketplaceMixin)

// Enable/Disable moxios. Default: true.
localStorage.setItem('isMoxios', 'false')

router.isReady().then(() => {
    app.mount('#app')
})