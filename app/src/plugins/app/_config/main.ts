import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import store from '@/plugins/app/_config/store'
import auth from '@/plugins/w/auth'
import axios from '@/plugins/w/axios'
import mocks from '@/plugins/w/moxios'
import emarketplace from '@/plugins/app@emarketplace'

import EMarketplaceMixin from '@/plugins/app@emarketplace/_mixins/emarketplace.mixin'

import '@/plugins/app/_themes/index.sass'


const app = createApp(App)
    .use(router)
    .use(store)
    .use(auth)
    .use(axios)
    .use(emarketplace)
    .use(mocks, {
        routes: {
            'GET api/v1/mall/categories': true,
            'GET api/v1/mall/listings': true,
        }
    })

app.mixin(EMarketplaceMixin)

// Enable/Disable moxios. Default: true.
localStorage.setItem('isMoxios', 'true')

router.isReady().then(() => {
    app.mount('#app')
})