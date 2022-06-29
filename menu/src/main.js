import { createApp } from 'vue'
import App from '@/App.vue'
import '@/css/main.css'

import route from '@/routes'

createApp(App)
    .use(route)
    .mount('#app')
