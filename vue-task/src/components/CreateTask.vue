<template>
	<div>
		<div class="row left-align">
			<button class="btn waves-effect waves-light col" type="submit" name="action" @click="!isCreating ? openForm() : closeForm()">
				<template v-if="!isCreating">
					<span>Add New</span>
					<i class="material-icons right">expand_more</i>
				</template>
				<template v-else>
					<span>Hide</span>
					<i class="material-icons right">expand_less</i>
				</template>
			</button>
		</div>
		<div class="row" v-show="isCreating">
			<div class="card horizontal col s12">
				<div class="card-stacked">
					<div class="card-content">
						<form class="col s12">
							<div class="row">
								<div class="input-field col s6">
									<input id="title" type="text" v-model="title">
									<label for="title">Title</label>
								</div>
								<div class="input-field col s6">
									<textarea id="description" class="materialize-textarea" v-model="description"></textarea>
									<label for="description">Description</label>
								</div>
							</div>
							<div class="row">
								<div class="switch col">
										<label>
												Not Done
												<input type="checkbox" v-model="doneCheck">
												<span class="lever"></span>
												Done
										</label>
								</div>
							</div>
						</form>
					</div>
					<div class="card-action">
						<div class="row">
							<button class="btn waves-effect waves-light col right" name="action" @click="closeForm()">
								Cancel
								<i class="material-icons right">cancel</i>
							</button>
							<div class="col right"></div>
							<button class="btn waves-effect waves-light col right" type="submit" name="action"
											@click="sendForm()">
									Add
									<i class="material-icons right">check_circle</i>
							</button>
						</div>
					</div><!--end card action-->
				</div>
			</div>		
		</div>
	</div>
</template>

<script>
import { mapActions} from 'vuex'
export default {
	data(){
		return {
			isCreating:false,
			title: '',
      description: '',
      doneCheck: false,
		}
	},
	methods:{
		...mapActions('tasks', ['createTask']),
		openForm(){
			this.isCreating = true
		},
		closeForm(){
			this.isCreating=false,
			this.title= '',
      this.description= '',
      this.doneCheck = false
		},
		sendForm(){
			let task = {
				title: this.title,
				description: this.description,
				done: this.doneCheck ,
				}
				
			this.createTask(task).catch(err=>console.log(err.response))
			
		},
		
	}
}
</script>