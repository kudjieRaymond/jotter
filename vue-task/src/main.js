import Vue from 'vue'
import App from './App.vue'
import router from './routes'
import Vuex from 'vuex'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
//window.$ = window.jQuery = require('jquery');

// eslint-disable-next-line
window.jQuery = $
window.$ = $
import  '../node_modules/materialize-css/dist/css/materialize.min.css'
import  '../node_modules/materialize-css/dist/js/materialize.min.js'


// eslint-disable-next-line
$(document).ready(function () {
  $('.sidenav').sidenav()
})

library.add(fas)
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.use(Vuex)
Vue.config.productionTip = false


new Vue({
	router,
  render: h => h(App),
}).$mount('#app')
