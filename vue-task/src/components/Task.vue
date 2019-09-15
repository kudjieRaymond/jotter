<template>
	<li class="collection-item">
		<div class="left-align" v-show="!isEditing">
			<label>
				<input type="checkbox" v-model="taskDone"/>
        <span><strong>{{ task.title }}</strong></span>
			</label>
			<p>{{task.description}}</p>
		</div>
		<div class="right-align" v-show="!isEditing">
			<a class="waves-effect waves-light btn-small" @click="openForm()">
				<i class="material-icons">mode_edit</i>
			</a>
			<a class="waves-effect waves-light btn-small red accent-2" @click="sendDeleteTask()">
				<i class="material-icons">delete</i>
			</a>
		</div>

		<form v-show="isEditing">
			<div class="left-align">
				<div class="input-field col s6">
						<input id="title" type="text" v-model="title">
						<label for="title" class="active">Title</label>
				</div>
				<div class="input-field col s6">
						<textarea id="description" class="materialize-textarea" v-model="description"></textarea>
						<label for="description" class="active">Description</label>
				</div>
			</div>
			<div class="right-align">
				<a class="waves-effect waves-light btn-small" @click="sendUpdateTask()">
					<i class="material-icons">check_circle</i>
				</a>
				<a class="waves-effect waves-light btn-small red accent-2" @click="closeForm()">
					<i class="material-icons">cancel</i>
				</a>
			</div>
		</form>
	</li>
</template>
<script>
import { mapActions } from 'vuex'
export default {
	data(){
		return {
			isEditing: false,
			title: '',
			description: '',
		}
	},
	props: ['task'],
	computed:{
		taskDone:{
			get(){
				return this.task.done
			},
			set(){
				this.sendToggleTask()
			}
		}
	},
	methods:{
		...mapActions('tasks', [
			'deleteTask', 'updateTask'
			]),
			openForm: function () {
        this.isEditing = true
        this.title = this.task.title
        this.description = this.task.description
			},
			closeForm : function () {
        this.isEditing = false
        this.title = ''
        this.description = ''
			},
			sendUpdateTask(){
				this.updateTask({
          id: this.task.id,
          updatedFields: {
            title: this.title,
						description: this.description,
						done: this.task.done
					}
				})
				this.closeForm()
			},
			sendDeleteTask: function () {
        this.deleteTask(this.task)
			},
			sendToggleTask(){
				this.updateTask({
          id: this.task.id,
          updatedFields: {
						 title: this.task.title,
						 description: this.task.description,
					 	done: this.task.done ? 0 : 1,
					 
					}
				})
				
			}


	}

}
</script>