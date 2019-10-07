
import JwtService from '../../common/jwt-service'
import client from '../../common/client'

const moduleAuthentication = {
	namespaced:true,
	state : {
		errors : null,
		user :{},
		isAuthenticated : !!JwtService.getToken()
	},
	getters: {
		currentUser(state){
			return state.user
		},
		isAuthenticated(state){
			return state.isAuthenticated
		}
	},
	mutations:{
		setError(state, error){
			state.error = error
		},
		setAuth(state, params){
			state.isAuthenticated = true
			state.user = params.user
			state.errors = {}
			JwtService.saveToken(params.access_token)
		},
		purgeAuth(state){
			state.isAuthenticated = false
			state.user = {},
			state.errors = null,
			JwtService.destroyToken()
		}

	},
	actions:{
		async register(context, payload){
			try{
				const {data} = await client.register(payload)
				context.commit('setAuth', data)
			}catch({response}){
				//console.log(response.data)
				context.commit('setError', response.data.errors)
				throw new Error(response.data.message)
			}
		},
		async login({commit}, payload){
			try{
				const {data} = await client.login(payload)
				commit('setAuth', data)
			}catch({response}){
				commit('setError', response.data.errors)
				throw new Error(response.data.message)
			}
			
		},
		logout({commit}){
			commit('purgeAuth')
		},
		async checkAuth ({commit}) {
			if (JwtService.getToken()) {
	
				try {
					const {data} = await client.me()
					commit('setAuth', data)
				} catch ({response}) {
					commit('setError', response.data.errors)
					throw new Error(response.data.message)
				}
			} else {
				commit('purgeAuth')
			}
		},
	}
}


export default moduleAuthentication