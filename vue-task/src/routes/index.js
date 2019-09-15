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
		component: Home
	},
	{
		path: '/register' ,
		name: 'register',
		component: Register
	},
	{
		path: '/login',
		name: 'login',
		component: Login
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



export default router