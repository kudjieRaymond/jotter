import client from '../../common/client'

const moduleHome = {
	namespaced: true,
	state:{
		tasks : [],
		isloading :false
	},
	getters:{
		tasks:state =>{
			return state.tasks
		},
		doneTasks:(state, getters) => {
			return getters.tasks  //.filter((task)=>{task.done === true || task.done === 1})
		},
		doneTasksCount:(state,getters)=>{
			return getters.doneTasks.length
		},	
		notDoneTasks:(state, getters)=>{
			return getters.tasks //.filter((task)=>{task.done === false || task.done === 0})
		},
		notDoneTasksCount:(state,getters)=>{
			return getters.notDoneTasks.length
		},
		isLoading:state =>{
			state.isLoading
		}
	},
	mutations:{
		fetchStart(state){
			state.isLoading = true
		},
		fetchEnd(state, tasks){
			state.tasks = tasks
			state.isLoading = false
		}

	},
	actions:{
		tasksFetch({commit}){
			commit('fetchStart')
			client.all()
				.then((res)=>{
					const {data:{data}} = res
					commit('fetchEnd', data)
				})
				.catch(err => {
					throw new Error(err)
				})
		},

	}
}

export default moduleHome