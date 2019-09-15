<template>
	<div>
		<nav>
			<div class="nav-wrapper">
				<router-link :to="{name : 'home'}"  class="brand-logo">Laravel-Vue-Task</router-link>

				<ul v-if="!isAuthenticated" id="nav-mobile" class="right hide-on-med-and-down">
					<li><router-link :to="{name: 'login'}">Login</router-link></li>
					<li><router-link :to="{name: 'register'}">Register</router-link></li>
				</ul>
				<ul v-else class="right hide-on-med-and-down">
					<li><a>Welcome, {{ currentUser.name }}</a></li>
					<li><a @click="handleLogout()">Logout</a></li>
					<li><a href="https://github.com/kudjieRaymond/jotter" target="_blank"><i class="fab fa-github"></i></a></li>
				</ul>
			</div>
		</nav>
		<ul id="slide-out" class="sidenav">
			<li><div class="user-view">
				<div class="background">
					<img src="images/office.jpg">
				</div>
				<a href="#user"><img class="circle" src="images/yuna.jpg"></a>
				<a href="#name"><span class="white-text name">John Doe</span></a>
				<a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
			</div></li>
			<li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
			<li><a href="#!">Second Link</a></li>
			<li><div class="divider"></div></li>
			<li><a class="subheader">Subheader</a></li>
			<li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
		</ul>
		<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

	</div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

export default {
	name: "Navbar",

	computed: {
      ...mapGetters('authentication',
        ['currentUser', 'isAuthenticated']
      )
    },

    methods: {
      ...mapActions('authentication',
        ['logout']
      ),

      handleLogout() {
				
        this.logout().then(() => {
          this.$router.push({name: 'login'})
        })
      }
    }
}
</script>
