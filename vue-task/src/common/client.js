import axios from 'axios'
import JwtService from './jwt-service'
import { API_URL } from './config.js'

const client = axios.create({
	baseURL : API_URL
})

client.defaults.headers.common['Authorization'] = `Bearer ${JwtService.getToken()}`;
client.defaults.headers.common['Content-type'] = 'application/json' ;
client.defaults.headers.common['Accept'] = 'application/json' ;

export default {
	register(data){
		return client.post('register', data)
	},
	login(data){
		return client.post('login', data)
	},
	me(){
		return client.post('me')
	},
	all(params){
		return client.get('tasks', params)
	},
	find(id){
		return client.get(`tasks/${id}`)

	},
	create(data){
		return client.post('tasks', data)
	},
	update(id, data){
		return client.put(`tasks/${id}`, data)
	},
	delete(id){
		return client.delete(`tasks/${id}`)
	}
}