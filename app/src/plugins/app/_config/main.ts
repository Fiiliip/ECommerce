import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import '@/plugins/app/_themes/index.sass'

const app = createApp(App)
    .use(router)

router.isReady().then(() => {
    app.mount('#app')
})