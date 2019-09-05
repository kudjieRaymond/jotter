
import JwtService from '../../common/jwt-service'
import client from '../../common/client'

const moduleAuthentication = {
	namespace:true,
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
				context.commit('setError', JSON.parse(response.data))
				throw new Error(JSON.parse(response.data))
			}
		},
		login({commit}, payload){
			client.login(payload)
						.then(({ data }) =>{
							commit('setAuth', data)
						})
						.catch(({ response }) => {
							console.log(JSON.parse(response))
						});
		},
		logout({commit}){
			commit('purgeAuth')
		},
		async CHECK_AUTH ({commit}) {
			if (JwtService.getToken()) {
	
				try {
					const {data} = await client.me()
					commit('setAuth', data)
				} catch ({response}) {
					commit('setError', JSON.parse(response.data))
					throw new Error(JSON.parse(response.data))
				}
			} else {
				commit('purgeAuth')
			}
		},
	}
}


export default moduleAuthentication