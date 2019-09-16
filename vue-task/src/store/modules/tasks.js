import client from '../../common/client'

const moduleTasks = {
	namespaced:true,
	state: {
	},

	actions:{
		async createTask(context, task){
			await client.create(task)
			context.dispatch('home/tasksFetch', null, {root:true})
		},
		async deleteTask(context, task){
			await client.delete(task.id)
			context.dispatch('home/tasksFetch', null, {root:true})
		},
		async updateTask(context, params){
			try{
				await client.update(params.id, params.updatedFields)
				context.dispatch('home/tasksFetch', null, {root:true})
			}catch({response}){
				throw new Error(response.data.message)
				
			}
			
		}

	}
	
}

export default moduleTasks