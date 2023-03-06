// require('dotenv').config()
import { createApp } from 'vue'
import VueLazyLoad from 'vue3-lazyload'
import App from '@/App.vue'

import '@/css/main.css'

import route from '@/routes'
import store from '@/store'


createApp(App)
    .use(route)
    .use(store)
    .use(VueLazyLoad)
    .mount('#app')
