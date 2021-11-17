import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
Vue.config.productionTip = false

import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
axios.defaults.headers.get['header-name'] = 'value'

Vue.use(VueMaterial)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
