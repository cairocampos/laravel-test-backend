import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Maska from 'maska'
import Loading from '@/components/global/Loading.vue';
import "@/assets/css/index.css"

const app = createApp(App);

// Componentes globais
app.component('Loading', Loading);

app.use(store)
app.use(router)
app.use(Maska)
app.mount('#app')


