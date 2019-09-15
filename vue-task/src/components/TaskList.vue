<template>
	<div>
		<div class="row">
      <div class="col s12 l5">
				<h3>Done ({{doneTasksCount}})</h3>
				<ul class="collection">
					<task v-for="task in doneTasks" :key="task.id" 
					:task="task"></task>
				</ul>
			</div>
			<div class="col col-content l2 hide-on-med-and-down"></div>
			<div class="col s12 l5">
				<h3>Not Done ({{notDoneTasksCount}})</h3>
				<ul class="collection">
					<task v-for="task in notDoneTasks" :key="task.id" 
					:task="task"></task>
				</ul>
			</div>
		</div>
	</div>
</template>
<script>
import Task from './Task'
import { mapGetters } from 'vuex'
export default {
	components:{
		Task
	},
	computed:mapGetters('home', [
		'tasks','doneTasks', 'doneTasksCount','notDoneTasks' ,'notDoneTasksCount', 'isLoading' ])
}
</script>