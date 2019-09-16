import Vue from 'vue'
import VueRouter from 'vue-router'
import Register from '../views/Register'
import Login from '../views/Login'
import Home from '../views/Home'
import store from '@/store'

Vue.use(VueRouter)


const routes = [
	{
		path: '/',
		name: 'home',
		component: Home,
		beforeEnter:verifyAuth
	},
	{
		path: '/register' ,
		name: 'register',
		component: Register,
		beforeEnter: checkGuest

	},
	{
		path: '/login',
		name: 'login',
		component: Login,
		beforeEnter: checkGuest

	},
	{
		path: '*',
		redirect: '/login'
	}
];

const router = new VueRouter({
	routes, // short for `routes: routes`
	mode: 'history'
})

async function verifyAuth(to, from, next){
	await store.dispatch('authentication/checkAuth')
	if(store.getters['authentication/isAuthenticated']){
		next()
	}else{
		next({
			name:'login',
			query: { redirect: to.fullPath }
		})
	}
}

async function checkGuest (to, from, next) {
  if (!store.getters['authentication/isAuthenticated']) {
    next()
  } else {
    next({
      name: 'home',
      query: { redirect: to.fullPath }
    })
  }
}

export default router