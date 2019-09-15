<template>
<div>
	<CreateTask/>
	<TaskList/>
</div>

</template>
<script>
import { mapActions } from 'vuex'
import CreateTask from '../components/CreateTask'
import TaskList from '../components/TaskList'
import store from '../store'

export default {
	components :{
		CreateTask,
		TaskList
	},
	methods:{
		...mapActions('home',['tasksFetch'])
	},
	beforeRouteEnter (to, from, next) {
	//this.tasksFetch().then(next())
	store.dispatch('home/tasksFetch')
	next()
}
}
</script>