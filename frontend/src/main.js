import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify' // path to vuetify export
import VueNoty from 'vuejs-noty'
Vue.use(VueNoty, {
  timeout: 4000
})
import 'vuejs-noty/dist/vuejs-noty.css'
Vue.config.productionTip = false

new Vue({
  store,
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
