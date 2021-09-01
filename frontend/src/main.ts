import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Loading from '@/components/global/Loading.vue';
import "@/assets/css/index.css"
import Swal from 'sweetalert2'


const app = createApp(App);

app.config.globalProperties.$Swal = Swal;

// Componentes globais
app.component('Loading', Loading);

app.use(store)
app.use(router)
app.mount('#app')


