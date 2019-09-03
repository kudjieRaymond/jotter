<template>
	<div class="row">
		<form>
			<div class="card horizontal col s12 l8 xl6 offset-l2 offset-xl3">
				<div class="card-stacked">
					<div class="card-content">
						<div class="row">
							<div class="input-field col s12">
								<input id="name" type="text" v-model="fullname">
								<label for="name">Name</label>
							</div>
							<div class="input-field col s12">
								<input id="email" type="text" v-model="email">
								<label for="email">Email</label>
							</div>
							<div class="input-field col s12">
								<input id="password" type="password" v-model="password">
								<label for="email">Password</label>
							</div>
							<div class="col s12">
								<label>
										<input type="checkbox" class="filled-in" v-model="termsCheck"/>
										<span>Creating an account means you're okay with our
										<a href="#">Terms of Service.</a>
								</span>
								</label>
							</div>
						</div>
					</div>
					<div class="card-action">
					<div class="row">
							<div class="col right"></div>
								<button class="btn waves-effect waves-light col s12 right" type="button"
												@click="sendForm()">
										Create Account
								</button>
						</div>
					</div>
				</div>
			</div>
		</form>
			
	</div>
</template>
<script>
export default {
	
	data(){
		return {
			fullname: '',
			email: '',
			password : '',
			termsCheck: ''
		}
	},
	methods:{
		sendForm(){

		}
	}
}
</script>