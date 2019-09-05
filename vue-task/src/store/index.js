import Vue from 'vue'
import Vuex from 'vuex'

import moduleAuthentication from './modules/authentication'
import moduleHome from './modules/home'
import moduleTasks from './modules/tasks'

Vue.use(Vuex)

const store = new Vuex.Store({
	modules:{
		home: moduleHome,
		authentication: moduleAuthentication,
		tasks: moduleTasks
	},

	strict: true //process.env.NODE_ENV !== 'production'
})

export default store
