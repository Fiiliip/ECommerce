import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import store from '@/plugins/app/_config/store'
import auth from '@/plugins/w/auth'
import axios from '@/plugins/w/axios'
import mocks from '@/plugins/w/moxios'
import ecommerce from '@/plugins/app@ecommerce'

import ECommerceMixin from '@/plugins/app@ecommerce/_mixins/ecommerce.mixin'

import '@/plugins/app/_themes/index.sass'


const app = createApp(App)
    .use(router)
    .use(store)
    .use(auth)
    .use(axios)
    .use(ecommerce)
    .use(mocks, {
        routes: {
            'GET api/v1/mall/categories': true,
            'GET api/v1/mall/products': true,
        }
    })

app.mixin(ECommerceMixin)

// Enable/Disable moxios. Default: true.
localStorage.setItem('isMoxios', 'true')

router.isReady().then(() => {
    app.mount('#app')
})