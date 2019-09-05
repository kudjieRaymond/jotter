import client from '../../common/client'

const moduleTasks = {
	namespace:true,
	state: {
	},

	actions:{
		async task_create(context, tasks){
			await client.create(tasks)
			context.dispatch('/home/tasks_fetch', null, {root:true})
		},
		async task_delete(context, task){
			await client.delete(task.id)
			context.dispatch('/home/tasks_fetch', null, {root:true})
		},
		async task_update(context, params){
			await client.update(params.id, params.updatedFields)
			context.dispatch('/home/tasks_fetch', null, {root:true})
		}

	}
	
}

export default moduleTasks